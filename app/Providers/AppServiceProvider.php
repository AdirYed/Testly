<?php

namespace App\Providers;

use BeyondCode\Mailbox\Facades\Mailbox;
use BeyondCode\Mailbox\InboundEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    public function boot()
    {
        Collection::macro('append', function ($accessors) {
            return $this->each(function (Model $model) use ($accessors) {
                return $model->append($accessors);
            });
        });

//        Mailbox::to('support@' . config('services.mailgun.domain'), function (InboundEmail $email) {
//
//        });
    }
}
