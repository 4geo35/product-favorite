<?php

use Illuminate\Support\Facades\Route;
use GIS\ProductFavorite\Http\Controllers\Web\FavoriteController;

Route::middleware(["web"])
    ->as("web.")
    ->group(function () {
        $controllerClass = config("product-favorite.customFavoriteWebController") ?? FavoriteController::class;
        Route::get("/favorite", [$controllerClass, "page"])->name("favorite");
    });
