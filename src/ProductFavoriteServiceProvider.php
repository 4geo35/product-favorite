<?php

namespace GIS\ProductFavorite;

use GIS\ProductFavorite\Helpers\FavoriteActionsManager;
use GIS\ProductFavorite\Livewire\Web\Catalog\FavoriteIcoWire;
use GIS\ProductFavorite\Livewire\Web\Catalog\FavoriteListWire;
use GIS\ProductFavorite\Livewire\Web\Catalog\SwitchFavoriteWire;
use GIS\ProductFavorite\Models\FavoriteList;
use GIS\ProductFavorite\Observers\FavoriteListObserver;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class ProductFavoriteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->mergeConfigFrom(__DIR__ . "/config/product-favorite.php", "product-favorite");
        $this->initFacades();
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . "/resources/views", "pf");
        $this->loadRoutesFrom(__DIR__ . "/routes/web.php");
        $this->observeModels();
        $this->addLivewireComponents();
    }

    protected function observeModels(): void
    {
        $listModelClass = config("product-favorite.customFavoriteListModel") ?? FavoriteList::class;
        $listObserverClass = config("product-favorite.customFavoriteListModel") ?? FavoriteListObserver::class;
        $listModelClass::observe($listObserverClass);
    }

    protected function addLivewireComponents(): void
    {
        $component = config("product-favorite.customSwitchFavoriteComponent");
        Livewire::component(
            "pf-switch-favorite",
            $component ?? SwitchFavoriteWire::class
        );

        $component = config("product-favorite.customFavoriteIcoComponent");
        Livewire::component(
            "pf-ico-favorite",
            $component ?? FavoriteIcoWire::class
        );

        $component = config("product-favorite.customFavoriteListComponent");
        Livewire::component(
            "pf-list-favorite",
            $component ?? FavoriteListWire::class
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
