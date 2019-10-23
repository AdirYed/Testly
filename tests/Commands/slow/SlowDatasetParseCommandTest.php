<?php

namespace Tests\Commands;

use App\Question;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SlowDatasetParseCommandTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        Storage::fake('local');

        $this->artisan('dataset:parse')
            ->expectsOutput("\n" . 'All of the images were stored successfully!');
    }

    /** @test */
    public function it_should_store_images_in_a_local_storage()
    {
        $img = Question::whereNotNull('image_url')->first()->only('image_url');

        Storage::disk('local')->assertExists($img);
    }
}
