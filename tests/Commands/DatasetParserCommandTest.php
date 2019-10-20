<?php

namespace Tests\Commands;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatasetParserCommandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_stores_categories_questions_and_answers()
    {
        $this->artisan('dataset:parse')
            ->expectsOutput('Dataset parsed and stored in the database successfully!');
    }
}
