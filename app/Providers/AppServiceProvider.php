<?php

namespace App\Providers;

use App\Observers\TestReportObserver;
use App\TestReport;
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
        TestReport::observe(TestReportObserver::class);
        Collection::macro('append', function ($accessors) {
            return $this->each(function (Model $model) use ($accessors) {
                return $model->append($accessors);
            });
        });
    }
}
