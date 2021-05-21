<?php

namespace JM\TMDB;

use Illuminate\Support\ServiceProvider;

class TMDBServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(TMDB::class);
        $this->app->alias(TMDB::class, 'tmdb');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/tmdb.php' => config_path('tmdb.php'),
        ]);
    }
}