<?php

namespace GIS\ProductFavorite\Helpers;

use GIS\CategoryProduct\Interfaces\ProductInterface;
use GIS\ProductFavorite\Interfaces\FavoriteListInterface;
use GIS\ProductFavorite\Models\FavoriteList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class FavoriteActionsManager
{
    public function initList(): FavoriteListInterface
    {
        $list = $this->getList();
        if ($list) return $list;
        $listModelClass = config("product-favorite.customFavoriteListModel") ?? FavoriteList::class;
        return $listModelClass::create([]);
    }

    public function getList(): ?FavoriteListInterface
    {
        $list = $this->findListByCookie();
        if ($list) return $list;
        return $this->findListByAuth();
    }

    public function switchProductFavorite(ProductInterface $product, FavoriteListInterface $customList = null): FavoriteListInterface
    {
        $list = $customList ?? $this->initList();

        if ($list->products()->where("product_id", $product->id)->count()) {
            $this->removeFromFavorite($product, $list);
        } else {
            $this->addToFavorite($product, $list);
        }

        $this->clearListIdsCache($list);

        return $list;
    }

    public function addToFavorite(ProductInterface $product, FavoriteListInterface $list): FavoriteListInterface
    {
        $list->products()->syncWithoutDetaching([
            $product->id
        ]);
        session()->flash("switchFavorite-success", "Товар добавлен в избранное");
        return $list;
    }

    public function removeFromFavorite(ProductInterface $product, FavoriteListInterface $list): FavoriteListInterface
    {
        $list->products()->detach($product);
        session()->flash("switchFavorite-success", "Товар убран из избранного");
        return $list;
    }

    public function getListIds(FavoriteListInterface $list = null): array
    {
        if (empty($list)) $list = $this->getList();
        if ($list) {
            $key = "favorite-actions-listIds:{$list->id}";
            $ids = Cache::rememberForever($key, function () use ($list) {
                $products = $list->products()->get();
                $ids = [];
                foreach ($products as $product) { $ids[] = $product->id; }
                return $ids;
            });
        } else { $ids = []; }
        return $ids;
    }

    public function clearList(FavoriteListInterface $customList = null): void
    {
        $list = $customList ?? $this->getList();
        if (! $list) return;
        $list->products()->detach();
        $list->save();
    }

    public function setCookie(FavoriteListInterface $list): void
    {
        if (Auth::check() && $list->user_id !== Auth::id()) { return; }
        $cookie = Cookie::make("favoriteUuid", $list->id, 60*24*30);
        Cookie::queue($cookie);
    }

    public function forgetCookie(): void
    {
        $cookie = Cookie::forget("favoriteUuid");
        Cookie::queue($cookie);
    }

    public function clearListCache(FavoriteListInterface $list): void
    {
        $uuid = $list->id;
        Cache::forget("favorite-actions-listByUuid:{$uuid}");

        $userId = $list->user_id;
        if (! empty($userId)) { Cache::forget("favorite-actions-listByUserId:{$userId}"); }

        $this->clearListIdsCache($list);
    }

    public function clearListIdsCache(FavoriteListInterface $list): void
    {
        Cache::forget("favorite-actions-listIds:{$list->id}");
    }

    protected function findListByAuth(): ?FavoriteListInterface
    {
        if (! Auth::check()) { return null; }
        return $this->findListByUserId(Auth::id());
    }

    protected function findListByCookie(): ?FavoriteListInterface
    {
        $cookie = Cookie::get("favoriteUuid", false);
        if (!$cookie) { return null; }
        $list = $this->findListByUuid($cookie);
        if (! $list) return null;
        // Если в куке был список, привязанный к юзверю,
        // а юзверя сейчас нет, то список не подходит.
        if (! Auth::check() && ! empty($list->user_id)) {
            $this->forgetCookie();
            return null;
        }
        $this->checkUserAuthList($list);
        return $list;
    }

    protected function checkUserAuthList(FavoriteListInterface $list): void
    {
        if (! Auth::check()) { return; }
        if (! empty($list->user_id)) { return; }
        $userList = $this->findListByUserId(Auth::id());
        // Если у юзверя был список,
        // нужно объеденить списки
        if ($userList && $userList->id !== $list->id) {
            $this->mergeLists($list, $userList);
        }
        $list->user_id = Auth::id();
        $list->save();
    }

    protected function mergeLists(FavoriteListInterface $anonymous, FavoriteListInterface $userList): void
    {
        foreach ($userList->products as $product) {
            $this->addToFavorite($product, $anonymous);
        }

        try {
            $userList->delete();
        } catch (\Exception $e) {
            Log::error("Не удалось удалить список {$userList->id}");
            $userList->user_id = null;
            $userList->save();
        }
    }

    protected function findListByUserId(int $id): ?FavoriteListInterface
    {
        $key = "favorite-actions-listByUserId:{$id}";
        return Cache::rememberForever($key, function () use ($id) {
            $listModelClass = config("product-favorite.customFavoriteListModel") ?? FavoriteList::class;
            try {
                return $listModelClass::query()
                    ->where("user_id", $id)
                    ->firstOrFail();
            } catch (\Exception $e) {
                return null;
            }
        });
    }

    protected function findListByUuid(string $uuid): ?FavoriteListInterface
    {
        $key = "favorite-actions-listByUuid:{$uuid}";
        return Cache::rememberForever($key, function () use ($uuid) {
            $listModelClass = config("product-favorite.customFavoriteListModel") ?? FavoriteList::class;
            try {
                return $listModelClass::query()->where("id", $uuid)->firstOrFail();
            } catch (\Exception $e) {
                return null;
            }
        });
    }
}
