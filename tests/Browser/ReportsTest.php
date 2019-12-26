<?php

namespace Tests\Browser;

use App\Category;
use App\DrivingLicenseType;
use App\Question;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ReportsTest extends DuskTestCase
{
    use DatabaseTransactions;

    /** @test */
    public function test_link_should_work()
    {
        $drivingLicenseType = DrivingLicenseType::inRandomOrder()->limit(1)->first();

        $this->browse(function (Browser $browser) use ($drivingLicenseType) {
            $browser->visit('/')
                ->mouseover('@test')
                ->assertSee("$drivingLicenseType->name ($drivingLicenseType->code)")
                ->clickLink("$drivingLicenseType->name")
                ->assertPathIs("/test/$drivingLicenseType->code");
        });
    }

    /** @test */
    public function it_should_save_reports_on_submit()
    {
        $user = factory(User::class)->create();

        factory(Category::class, 4)->create();

        $drivingLicenseType = DrivingLicenseType::inRandomOrder()->first();

        $questions = factory(Question::class, 60)->states('with_answers')->create();
        $drivingLicenseType->questions()->attach($questions);

        $this->browse(function (Browser $browser) use ($drivingLicenseType, $user) {
            $browser->visit('/')
                ->script("window.localStorage.setItem('user', " . json_encode(['first_name' => $user->first_name, 'last_name' => $user->last_name, 'email' => $user->email]) . ");");

            $browser->visit('/')
                ->script("window.localStorage.setItem('token', '" . JWTAuth::fromUser($user) . "');");

            $browser->visit('/test/' . $drivingLicenseType->code)
                ->waitUntilVue('quiz.length', 30, '@quiz')
                ->assertSee('מבחן תאוריה - ' . "{$drivingLicenseType->name} ({$drivingLicenseType->code})")
                ->press('סיים מבחן');
        });
dd($user->testReports);
        $this->assertEquals(1, $user->testReports()->count());

        $this->assertDatabaseHas('test_reports', [
            'user_id' => $user->id,
            'driving_license_type_id' => $drivingLicenseType->id,
        ]);
    }
}
