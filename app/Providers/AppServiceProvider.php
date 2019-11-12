<?php

namespace App\Providers;

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
    }

    public function boot()
    {
        Collection::macro('append', function ($accessors) {
            return $this->each(function (Model $model) use ($accessors) {
                return $model->append($accessors);
            });
        });
    }
}
