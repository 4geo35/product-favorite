<?php

use Illuminate\Support\Facades\Route;

Route::middleware(["web"])
    ->as("web.")
    ->group(function () {
        Route::get("/favorite", function () {
            return "favorite";
        })->name("favorite");
    });
