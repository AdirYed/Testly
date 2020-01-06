<?php

namespace Tests\TheoryTest;

use App\Http\Controllers\AuthController;
use App\UrlToken;
use App\Notifications\VerifyUserNotification;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();

        Notification::fake();
    }

    /** @test */
    public function an_email_must_be_sent_on_register()
    {
        $url = action([
            AuthController::class, 'register'
        ]);

        $payload = [
            'first_name' => 'moses',
            'last_name' => 'moshe',
            'email' => 'moses@gmail.com',
            'password' => 123123,
            'password_confirmation' => 123123,
        ];

        $this->post($url, $payload);

        $this->assertDatabaseHas('users', [
            'email' => 'moses@gmail.com',
            'email_verified_at' => null,
        ]);

        $user = User::whereEmail('moses@gmail.com')->first();

        Notification::assertSentTo(
            $user,
            VerifyUserNotification::class,
            function (VerifyUserNotification $notification) use ($user) {
                $notification->toMail($user);
                return $user->urlTokens()->whereType(UrlToken::TYPE_VERIFICATION)->count() === 1;
            }
        );
    }

    /** @test */
    public function verification_email_should_verify_user()
    {
        $user = factory(User::class)->create(['email_verified_at' => null]);

        $user->notify(new VerifyUserNotification);

        Notification::assertSentTo(
            $user,
            VerifyUserNotification::class,
            function (VerifyUserNotification $notification) use ($user) {
                $notification->toMail($user);

                $urlToken = $user->urlTokens()->whereType(UrlToken::TYPE_VERIFICATION)->first();

                $response = $this->get(UrlToken::verifyUrl($urlToken->token));

                $user->refresh();

                $response->assertRedirect('/login?verified=1');

                return $user->email_verified_at !== null;
            }
        );
    }
}
