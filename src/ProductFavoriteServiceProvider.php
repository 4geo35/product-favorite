<?php

namespace GIS\ProductFavorite;

use Illuminate\Support\ServiceProvider;

class ProductFavoriteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->mergeConfigFrom(__DIR__ . "/config/product-favorite.php", "product-favorite");
        $this->loadRoutesFrom(__DIR__ . "/routes/web.php");
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . "/resources/views", "pf");
    }
}
