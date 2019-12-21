<?php

namespace App\Console\Commands;

use App\Answer;
use App\Category;
use App\DrivingLicenseType;
use App\Question;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use PHPUnit\Util\Xml;
use Storage;

class ParseDatasetCommand extends Command
{
    protected $signature = 'dataset:parse {--without-images}';

    protected $description = 'Parse the dataset and store in the database';

    private const IMAGES_DIRECTORY = 'question-images';

    /**
     * The amount of rows will be stored in every DB operation
     *
     * @var int
     */
    private const INSERT_CHUNK_SIZE = 25;

    /**
     * @var array the images that should be stored
     */
    private $images = [];

    /** @var Carbon */
    private $now;

    /** @var Collection */
    private $dataset;

    /** @var EloquentCollection */
    private $drivingLicenseTypes;

    /** @var EloquentCollection */
    private $categories;

    /** @var EloquentCollection */
    private $questions;

    public function handle(): void
    {
        $startTime = microtime(true);

        $this->clearDb();

        $datasetPaths = [
            config('theory_test.datasets.general'),
            config('theory_test.datasets.a3'),
        ];

        $this->dataset = $this->getMergedDatasets($datasetPaths);

        $this->parseDataset();

        $this->info('Dataset parsed and stored in the database successfully!');

        if ($this->shouldStoreImages()) {
            $this->deleteStorage();
            $this->storeImages();

            $this->info(PHP_EOL);
            $this->info('All of the images were stored successfully!');
        }

        $finishTime = microtime(true);
        $executionTimeSeconds = ($finishTime - $startTime);

        $this->info('Command execution time: ' . $executionTimeSeconds);
    }

    private function clearDb(): void
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Question::truncate();
        Answer::truncate();
        DB::table('driving_license_type_question')->truncate();
        Schema::enableForeignKeyConstraints();
    }

    private function getMergedDatasets(array $paths): Collection
    {
        $mergedDatasets = collect();

        foreach ($paths as $path) {
            $mergedDatasets = $mergedDatasets->merge(
                $this->getDataset($path)
            );
        }

        return $mergedDatasets;
    }

    private function getDataset(string $path): Collection
    {
        $datasetSimpleXml = simplexml_load_file($path, 'SimpleXMLElement', LIBXML_NOCDATA);
        $datasetJson = json_encode((array) $datasetSimpleXml->channel);

        return collect(json_decode($datasetJson, true)['item'])->values();
    }

    private function parseDataset(): void
    {
        $this->drivingLicenseTypes = DrivingLicenseType::all();
        $this->now = now();

        $this->categories = $this->storeCategories();

        $this->questions = $this->storeQuestions();

        $this->attachQuestionsToDrivingLicenseTypes();

        $this->storeAnswers();
    }

    private function storeCategories(): EloquentCollection
    {
        $categoriesData = $this->dataset->unique('category')->map(function (array $item): array {
            return [
                'name' => $item['category'],
                'created_at' => $this->now,
                'updated_at' => $this->now,
            ];
        })->toArray();

        Category::insert($categoriesData);

        return Category::all();
    }

    private function storeQuestions(): Collection
    {
        $this->dataset->map(function (array $item): array {
            preg_match('/(?<original_id>\d+)(\.)(?<title>.+)/', $item['title'], $matches);

            $data = [
                'title' => trim(htmlspecialchars_decode($matches['title'])),
                'image_url' => null,
                'original_id' => intval($matches['original_id']),
                'category_id' => $this->categories->firstWhere('name', $item['category'])->id,
                'created_at' => $this->now,
                'updated_at' => $this->now,
            ];

            $html = simplexml_load_string($item['description']);

            if (isset($html->img['src'])) {
                $url = (string) $html->img['src'];

                if ($this->shouldStoreImages()) {
                    $uuid = Str::uuid()->toString();
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
        })
            ->chunk(self::INSERT_CHUNK_SIZE)
            ->each(static function (Collection $chunkedQuestionsData): void {
                Question::insert($chunkedQuestionsData->toArray());
            });

        return Question::select(['id', 'original_id', 'title'])->get();
    }

    private function attachQuestionsToDrivingLicenseTypes(): void
    {
        $drivingLicenseTypeQuestionData = collect([]);

        $this->questions->each(function (Question $question) use ($drivingLicenseTypeQuestionData) {
            $datasetItem = $this->getQuestionXmlItemByModelQuestion($question);

            $html = simplexml_load_string($datasetItem['description']);
            $questionDrivingLicenseTypesString = htmlspecialchars_decode($html->div->span[1]);
            preg_match_all('/«(.*?)»/', $questionDrivingLicenseTypesString, $matches);
            $questionDrivingLicenseTypes = $matches[1];

            $this->drivingLicenseTypes
                ->filter(static function (DrivingLicenseType $drivingLicenseType) use ($questionDrivingLicenseTypes): bool {
                    return in_array($drivingLicenseType->code, $questionDrivingLicenseTypes);
                })
                ->each(static function (DrivingLicenseType $drivingLicenseType) use ($question, $drivingLicenseTypeQuestionData) {
                    $drivingLicenseTypeQuestionData->push([
                        'question_id' => $question->id,
                        'driving_license_type_id' => $drivingLicenseType->id,
                    ]);
                });
        });

        $drivingLicenseTypeQuestionData->chunk(self::INSERT_CHUNK_SIZE)
            ->each(function (Collection $chunkedDrivingLicenseTypeQuestionData) {
                DB::table('driving_license_type_question')->insert($chunkedDrivingLicenseTypeQuestionData->toArray());
            });
    }

    private function storeAnswers(): void
    {
        $answersData = collect([]);

        $this->dataset->each(function (array $item) use ($answersData): void {
            preg_match('/(?<original_id>\d+)(\.)(?<title>.+)/', $item['title'], $matches);

            $question = $this->getQuestionModelByXmlItem($matches);;

            $html = simplexml_load_string($item['description']);

            foreach ($html->ul->li as $answer) {
                $answersData->push([
                    'content' => htmlspecialchars_decode($answer->span),
                    'is_correct' => $answer->span['id'] == 'correctAnswer' . $matches['original_id'],
                    'question_id' => $question->id,
                    'created_at' => $this->now,
                    'updated_at' => $this->now,
                ]);
            }
        });

        $answersData->chunk(self::INSERT_CHUNK_SIZE)
            ->each(function (Collection $chunkedAnswersData) {
                Answer::insert($chunkedAnswersData->toArray());
            });
    }

    protected function shouldStoreImages(): bool
    {
        return $this->input->hasOption('without-images')
            && ! $this->option('without-images');
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

    protected function getQuestionXmlItemByModelQuestion($question): array
    {
        return $this->dataset->filter(static function (array $item) use ($question) {
            return Str::startsWith($item['title'], $question->getOriginalIdWithLeadingZeros())
                && Str::contains($item['title'], $question->title);
        })->first();
    }

    protected function getQuestionModelByXmlItem($matches): Question
    {
        return $this->questions->filter(static function (Question $item) use ($matches) {
            return Str::startsWith($item->original_id, trim($matches['original_id'], 0))
                && Str::contains($item->title, trim(htmlspecialchars_decode($matches['title'])));
        })->first();
    }
}
