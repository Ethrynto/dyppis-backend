<?php

use App\Http\Controllers\Api\V1\ProductService\PlatformController;
use App\Http\Controllers\Api\V1\UserService\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('test', [UserController::class, 'index']);

Route::prefix('debug')->group(function () {
    Route::get('/mediafiles', [\App\Http\Controllers\MediafileController::class, 'index']);
});

Route::prefix('v1')->group(function () {
    // Route::get('/users', [UserController::class, 'index']);

    Route::get('/platform-categories', [\App\Http\Controllers\Api\V1\ProductService\PlatformCategoryController::class, 'index']);

    Route::prefix('auth')->group(function () {
        Route::post('/authorization', [AuthController::class, 'authorization'])   // User authorization
            ->name('authorization');
        Route::post('/registration', [AuthController::class, 'registration'])     // User registration
            ->name('registration');
        Route::post('/logout', [AuthController::class, 'logout'])                 // User logout
            ->middleware('auth:sanctum')
            ->name('logout');
    });

    /*
     *  Platform CRUD operations
     */
    Route::prefix('platforms')->group(function () {

        Route::get('/', [PlatformController::class, 'index'])               // Get all platforms
            ->name('platforms.index');
        Route::get('/{id}', [PlatformController::class, 'show'])            // Get a platform by ID
            ->name('platforms.show');
        Route::post('/', [PlatformController::class, 'store'])              // Create a new platform
            ->name('platforms.store')
            ->middleware('auth:sanctum');
        Route::patch('/{id}', [PlatformController::class, 'update'])         // Update a platform by ID
            ->name('platforms.update')
            ->middleware('auth:sanctum');
        Route::delete('/{id}', [PlatformController::class, 'destroy'])      // Remove a platform by ID
            ->name('platforms.destroy');

    });
});
