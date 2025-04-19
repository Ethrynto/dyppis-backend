<?php

use App\Http\Controllers\Api\V1\ProductService\PlatformController;
use App\Http\Controllers\Api\V1\UserService\UserController;
use Illuminate\Support\Facades\Route;


Route::get('test', [UserController::class, 'index']);

Route::prefix('debug')->group(function () {
    Route::get('/mediafiles', [\App\Http\Controllers\MediafileController::class, 'index']);
});

Route::prefix('v1')->group(function () {
    // Route::get('/users', [UserController::class, 'index']);

    Route::get('/platform-categories', [\App\Http\Controllers\Api\V1\ProductService\PlatformCategoryController::class, 'index']);

    Route::prefix('platforms')->group(function () {
        Route::get('/', [PlatformController::class, 'index']);      // Get all platforms
        Route::get('/{id}', [PlatformController::class, 'show']);   // Get a platform by ID
    });
});
