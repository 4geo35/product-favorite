<?php

namespace GIS\ProductFavorite\Facades;

use GIS\CategoryProduct\Interfaces\ProductInterface;
use GIS\ProductFavorite\Helpers\FavoriteActionsManager;
use GIS\ProductFavorite\Interfaces\FavoriteListInterface;
use Illuminate\Support\Facades\Facade;

/**
 * @method static FavoriteListInterface initList()
 * @method static FavoriteListInterface|null getList()
 *
 * @method static FavoriteListInterface switchProductFavorite(ProductInterface $product, FavoriteListInterface $customList = null)
 * @method static FavoriteListInterface addToFavorite(ProductInterface $product, FavoriteListInterface $list)
 * @method static FavoriteListInterface removeFromFavorite(ProductInterface $product, FavoriteListInterface $list)
 * @method static array getListIds(FavoriteListInterface $list = null)
 * @method static void clearList(FavoriteListInterface $customList = null)
 *
 * @method static void setCookie(FavoriteListInterface $list)
 * @method static void forgetCookie()
 * @method static void clearListCache(FavoriteListInterface $list)
 *
 * @see FavoriteActionsManager
 */
class FavoriteActions extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return "favorite-actions";
    }
}
