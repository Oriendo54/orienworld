<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class POFServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path() . '/Helpers/POF/CoursHelper.php';
        require_once app_path() . '/Helpers/POF/FactureHelper.php';
        require_once app_path() . '/Helpers/POF/DateHelper.php';
        require_once app_path() . '/Helpers/POF/StatsHelper.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
