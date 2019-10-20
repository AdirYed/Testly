<?php

namespace App\Console\Commands;

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

        $categories = Category::all();

        // Store questions
        Question::insert(
            $dataset->map(static function ($item) use ($categories) {
                preg_match('/(?<original_id>\d+)(\.)(?<title>.+)/', $item['title'], $matches);

                $data = [
                    'title' => $matches['title'],
                    'image_url' => null,
                    'original_id' => (int) $matches['original_id'],
                    'category_id' => $categories->firstWhere('name', $item['category'])->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $html = simplexml_load_string($item['description']);

                if (isset($html->img)) {
                    $data['image_url'] = $html->img['src'];
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
    }
}
