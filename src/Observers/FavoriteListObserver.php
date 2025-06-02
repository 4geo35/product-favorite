<?php

namespace GIS\ProductFavorite\Observers;

use GIS\ProductFavorite\Facades\FavoriteActions;
use GIS\ProductFavorite\Interfaces\FavoriteListInterface;
use GIS\ProductFavorite\Models\FavoriteList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FavoriteListObserver
{
    public function creating(FavoriteListInterface $list): void
    {
        $uuid = Str::uuid();
        $listModelClass = config("product-favorite.customFavoriteListModel") ?? FavoriteList::class;
        while ($listModelClass::find($uuid)) { $uuid = Str::uuid(); }
        $list->id = $uuid;

        if (Auth::check()) $list->user_id = Auth::id();
    }

    public function created(FavoriteListInterface $list): void
    {
        FavoriteActions::setCookie($list);
    }

    public function updated(FavoriteListInterface $list): void
    {
        FavoriteActions::setCookie($list);
        FavoriteActions::clearListCache($list);
    }

    public function deleted(FavoriteListInterface $list): void
    {
        $list->products()->sync([]);
        FavoriteActions::clearListCache($list);
    }
}
