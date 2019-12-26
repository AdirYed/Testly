<?php

namespace Tests\TheoryTest;

use App\Category;
use App\Http\Controllers\CategoryTypeController;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CategoryTypesTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_should_return_category_types()
    {
        factory(Category::class, 4)->create();

        $url = action([
            CategoryTypeController::class,
            'index',
        ]);

        $response = $this->json('get', $url);

        $this->assertEquals(4, count($response->original));

        $response->assertJsonStructure([
            [
                'id',
                'name',
            ]
        ]);
    }
}
