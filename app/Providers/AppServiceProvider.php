<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Pages;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->share('test', 'Фотостудия');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
