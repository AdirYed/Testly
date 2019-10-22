<?php

namespace App\Console\Commands;

use App;
use Storage;
use App\Answer;
use App\Category;
use App\Question;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class ParseDatasetCommand extends Command
{
    protected $signature = 'dataset:parse';

    protected $description = 'Parse the dataset and store in the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Question::truncate();
        Answer::truncate();
        Schema::enableForeignKeyConstraints();

        $datasetSimpleXml = simplexml_load_file(
            config('theory_test.dataset.path'),
            'SimpleXMLElement',
            LIBXML_NOCDATA
        );
        $datasetJson = json_encode((array) $datasetSimpleXml->channel);
        $dataset = collect(json_decode($datasetJson, true)['item'])->values();

        // Store categories
        Category::insert(
            $dataset->unique('category')->map(static function ($item) {
                return [
                    'name' => $item['category'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            })->all()
        );

        $urls = [];

        $categories = Category::all();

        // Store questions
        Question::insert(
            $dataset->map(static function ($item) use ($categories, &$urls) {
                preg_match('/(?<original_id>\d+)(\.)(?<title>.+)/', $item['title'], $matches);

                $data = [
                    'title' => trim($matches['title']),
                    'image_url' => null,
                    'original_id' => (int) $matches['original_id'],
                    'category_id' => $categories->firstWhere('name', $item['category'])->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $html = simplexml_load_string($item['description']);

                if(isset($html->img['src'])) {
                    $url = (string) $html->img['src'];
                    $name = substr($url, strrpos($url, '/') + 1);

                    $urls[] = [
                        'name' => $name,
                        'url' => $url,
                    ];

                    $data['image_url'] = 'images/' . $name;
                }

                return $data;
            })->all()
        );

        $questions = Question::select(['id', 'original_id'])->get();

        $answersData = [];

        $dataset->each(static function ($item) use ($questions, &$answersData) {
            preg_match('/(?<original_id>\d+)/', $item['title'], $matches);
            $question = $questions->firstWhere('original_id', $matches['original_id']);

            $html = simplexml_load_string($item['description']);

            foreach ($html->ul->li as $answer) {
                $answersData[] = [
                    'content' => $answer->span,
                    'is_correct' => $answer->span['id'] == 'correctAnswer' . $matches['original_id'],
                    'question_id' => $question->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        })->all();

        Answer::insert($answersData);

        $this->info('Dataset parsed and stored in the database successfully!');
        $this->info('Do not shut down the terminal yet, the images are getting stored right now.');

        if(Storage::disk('storage')->exists('/images')) {
            Storage::disk('storage')->deleteDirectory('images');
        }

        // Store images in a local directory
        $start = curl_init ();
        foreach ($urls as $url) {
            $name =  $url['name'];
            $url = $url['url'];

            curl_setopt_array($start, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_SSLVERSION => 3
            ]);

            $name = "images/{$name}";

            $contents = curl_exec($start);

            Storage::disk('storage')->put($name, $contents);
        }
        curl_close ($start);

        $this->info('All of the images were stored successfully!');
    }
}
