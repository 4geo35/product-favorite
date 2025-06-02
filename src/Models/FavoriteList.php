<?php

namespace GIS\ProductFavorite\Models;

use App\Models\User;
use GIS\CategoryProduct\Models\Product;
use GIS\ProductFavorite\Interfaces\FavoriteListInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FavoriteList extends Model implements FavoriteListInterface
{
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [];

    public function products(): BelongsToMany
    {
        $productModelClass = config("category-product.customProductModel") ?? Product::class;
        return $this->belongsToMany($productModelClass)
            ->withTimestamps();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
