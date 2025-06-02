<?php

namespace GIS\ProductFavorite\Facades;

use GIS\ProductFavorite\Helpers\FavoriteActionsManager;
use Illuminate\Support\Facades\Facade;

/**
 * @see FavoriteActionsManager
 */
class FavoriteActions extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return "favorite-actions";
    }
}
