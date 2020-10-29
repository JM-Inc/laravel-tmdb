<?php

namespace JM\TMDB;

use Illuminate\Support\ServiceProvider;

class TMDBServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TMDB::class);
        $this->app->alias(TMDB::class, 'tmdb');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/tmdb.php' => config_path('tmdb.php'),
        ]);
    }
}