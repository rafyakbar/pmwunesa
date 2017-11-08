<?php

namespace PMW\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('ExcelExport','PMW\Support\ExcelExport');
        $this->app->bind('Dana','PMW\Support\Dana');
        $this->app->bind('PMW\Contract\FileHandler', 'PMW\Support\FileHandler\LocalStorage');
    }

}
