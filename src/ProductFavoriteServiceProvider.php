<?php

namespace GIS\ProductFavorite;

use GIS\ProductFavorite\Helpers\FavoriteActionsManager;
use GIS\ProductFavorite\Livewire\Web\Catalog\SwitchFavoriteWire;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class ProductFavoriteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->mergeConfigFrom(__DIR__ . "/config/product-favorite.php", "product-favorite");
        $this->loadRoutesFrom(__DIR__ . "/routes/web.php");
        $this->initFacades();
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . "/resources/views", "pf");
        $this->addLivewireComponents();
    }

    protected function addLivewireComponents(): void
    {
        $component = config("product-favorite.customSwitchFavoriteComponent");
        Livewire::component(
            "pf-switch-favorite",
            $component ?? SwitchFavoriteWire::class
        );
    }

    protected function initFacades(): void
    {
        $this->app->singleton("favorite-actions", function () {
            $managerClass = config("product-favorite.customFavoriteActionsManager") ?? FavoriteActionsManager::class;
            return new $managerClass();
        });
    }
}
