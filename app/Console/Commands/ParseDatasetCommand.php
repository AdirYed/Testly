<?php

namespace App\Console\Commands;

use App;
use App\DrivingLicenseType;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Storage;
use App\Answer;
use App\Category;
use App\Question;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class ParseDatasetCommand extends Command
{
    protected $signature = 'dataset:parse {--without-images} {--without-general} {--without-electric-bicycle}';

    protected $description = 'Parse the dataset and store in the database';

    /**
     * @var array    array of images that should be stored
     */
    private $images = [];

    private const IMAGES_DIRECTORY = 'question-images';

    public function handle(): void
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Question::truncate();
        Answer::truncate();
        DB::table('driving_license_type_question')->truncate();
        Schema::enableForeignKeyConstraints();

        $drivingLicenseTypes = DrivingLicenseType::all();

        if ($this->shouldParseGeneral()) {
            $this->parseDataset(
                config('theory_test.datasets.general'),
                $drivingLicenseTypes->where('code', '!=', 'A3')
            );
        }

        if ($this->shouldParseElectricBicycle()) {
            $this->parseDataset(
                config('theory_test.datasets.a3'),
                $drivingLicenseTypes->where('code', 'A3')
            );
        }

        if (! $this->shouldParseGeneral() && ! $this->shouldParseElectricBicycle()) {
            $this->error('You must choose at least one dataset to parse.');
            return;
        }

        $this->info('Dataset parsed and stored in the database successfully!');

        if ($this->shouldStoreImages()) {
            $this->deleteStorage();
            $this->storeImages();

            $this->info("\n" . 'All of the images were stored successfully!');
        }
    }

    protected function shouldParseGeneral(): bool
    {
        return $this->input->hasOption('without-general')
            && ! $this->option('without-general');
    }

    protected function shouldParseElectricBicycle(): bool
    {
        return $this->input->hasOption('without-electric-bicycle')
            && ! $this->option('without-electric-bicycle');
    }

    protected function shouldStoreImages(): bool
    {
        return $this->input->hasOption('without-images')
            && ! $this->option('without-images');
    }

    private function parseDataset(string $dataset_path, Collection $drivingLicenseTypes): void
    {
        $datasetSimpleXml = simplexml_load_file($dataset_path, 'SimpleXMLElement', LIBXML_NOCDATA);
        $datasetJson = json_encode((array) $datasetSimpleXml->channel);
        $dataset = collect(json_decode($datasetJson, true)['item'])->values();
        $now = now();

        // Store categories
        $categoriesData = $dataset->unique('category')->map(static function ($item) use ($now) {
            return [
                'name' => $item['category'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        })->all();

        Category::insert($categoriesData);

        $categories = Category::whereIn('name', array_column($categoriesData, 'name'))
            ->get();

        // Store questions
        $questionsData = $dataset->map(function ($item) use ($categories, $now) {
            preg_match('/(?<original_id>\d+)(\.)(?<title>.+)/', $item['title'], $matches);

            $data = [
                'title' => trim(htmlspecialchars_decode($matches['title'])),
                'image_url' => null,
                'original_id' => (int) $matches['original_id'],
                'category_id' => $categories->firstWhere('name', $item['category'])->id,
                'created_at' => $now,
                'updated_at' => $now,
            ];

            $html = simplexml_load_string($item['description']);

            if (isset($html->img['src'])) {
                $url = (string) $html->img['src'];

                if ($this->shouldStoreImages()) {
                    $uuid = (string) Str::uuid();
                    $name = self::IMAGES_DIRECTORY . '/img_' . $uuid . '.' . File::extension($url);

                    $this->images[] = [
                        'name' => $name,
                        'url' => $url,
                    ];

                    $data['image_url'] = $name;
                } else {
                    $data['image_url'] = $url;
                }
            }

            return $data;
        })->all();

        Question::insert($questionsData);

        $questions = Question::select(['id', 'original_id'])
            ->whereIn('category_id', $categories->pluck('id'))
            ->get();

        $questions->each(static function (Question $question) use ($drivingLicenseTypes) {
            $question->drivingLicenseTypes()->attach($drivingLicenseTypes);
        });

        $answersData = [];

        $dataset->each(static function ($item) use ($questions, &$answersData, $now) {
            preg_match('/(?<original_id>\d+)/', $item['title'], $matches);
            $question = $questions->firstWhere('original_id', $matches['original_id']);

            $html = simplexml_load_string($item['description']);

            foreach ($html->ul->li as $answer) {
                $answersData[] = [
                    'content' => htmlspecialchars_decode($answer->span),
                    'is_correct' => $answer->span['id'] == 'correctAnswer' . $matches['original_id'],
                    'question_id' => $question->id,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        })->all();

        Answer::insert($answersData);
    }

    protected function storeImages(): void
    {
        $bar = $this->output->createProgressBar(count($this->images));

        $bar->start();

        $start = curl_init();
        foreach ($this->images as $image) {
            $name = $image['name'];
            $url = $image['url'];

            curl_setopt_array($start, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_SSLVERSION => 3,
            ]);

            $contents = curl_exec($start);

            Storage::put("public/{$name}", $contents);

            $bar->advance();
        }

        $bar->finish();
        curl_close($start);
    }

    protected function deleteStorage(): void
    {
        if (Storage::exists('public/' . self::IMAGES_DIRECTORY)) {
            Storage::deleteDirectory('public/' . self::IMAGES_DIRECTORY);
        }
    }
}
