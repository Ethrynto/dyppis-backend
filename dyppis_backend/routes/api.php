<?php

use App\Http\Controllers\Api\V1\ProductService\CategoryController;
use App\Http\Controllers\Api\V1\ProductService\PlatformCategoryController;
use App\Http\Controllers\Api\V1\ProductService\PlatformController;
use App\Http\Controllers\Api\V1\ProductService\ProductController;
use App\Http\Controllers\Api\V1\UserService\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


/**
 *  Debug routes
 */
Route::prefix('debug')->group(function () {
    Route::get('/mediafiles', [\App\Http\Controllers\MediafileController::class, 'index']);
});


/**
 *  API routes (Version 1)
 */
Route::prefix('v1')->group(function () {
    // Route::get('/users', [UserController::class, 'index']);

    Route::get('/platform-categories', [\App\Http\Controllers\Api\V1\ProductService\PlatformCategoryController::class, 'index']);


    /**
     *  Auth routes
     */
    Route::prefix('auth')->group(function () {
        Route::post('/authorization', [AuthController::class, 'authorization'])   // User authorization
            ->name('authorization');

        Route::post('/registration', [AuthController::class, 'registration'])     // User registration
            ->name('registration');

        Route::get('/logout', [AuthController::class, 'logout'])                  // User logout
            ->middleware('auth:sanctum')
            ->name('logout');
    });


    /**
     *  User operations
     */
    Route::prefix('users')->group(function () {

        Route::post('/{id}/role', [\App\Http\Controllers\AuthRoleController::class, 'update'])
            ->middleware(['auth:sanctum', 'role:admin']);
    });


    /**
     *  Platform CRUD operations
     */
    Route::prefix('platforms')->group(function () {

        Route::get('/', [PlatformController::class, 'index'])               // Get all platforms
            ->name('platforms.index');
        Route::get('/{id}', [PlatformController::class, 'show'])            // Get a platform by ID
            ->name('platforms.show');
        Route::post('/', [PlatformController::class, 'store'])              // Create a new platform
            ->name('platforms.store')
            ->middleware(['auth:sanctum', 'role:admin,moderator']);
        Route::patch('/{id}', [PlatformController::class, 'update'])        // Update a platform by ID
            ->name('platforms.update')
            ->middleware(['auth:sanctum', 'role:admin,moderator']);
        Route::delete('/{id}', [PlatformController::class, 'destroy'])      // Remove a platform by ID
            ->name('platforms.destroy')
            ->middleware(['auth:sanctum', 'role:admin']);


        /**
         *  Platform categories
         */

        Route::get('/{id}/categories', [PlatformCategoryController::class, 'index'])
            ->name('platforms.categories.store');

        Route::post('/{id}/categories', [PlatformCategoryController::class, 'store'])
            ->name('platforms.categories.store');
            //->middleware('auth:sanctum');

        Route::delete('/{id}/categories', [PlatformCategoryController::class, 'destroy'])
            ->name('platforms.categories.destroy');
            //->middleware('auth:sanctum');
    });


    /**
     *  Categories CRUD operations
     */
    Route::prefix('categories')->group(function () {

        Route::get('/', [CategoryController::class, 'index'])               // Get all categories
            ->name('categories.index');

        Route::get('/{id}', [CategoryController::class, 'show'])            // Get a category by ID
            ->name('categories.show');

        Route::post('/', [CategoryController::class, 'store'])              // Create a new category
            ->name('categories.store')
            ->middleware(['auth:sanctum', 'role:admin,moderator']);

        Route::patch('/{id}', [CategoryController::class, 'update'])        // Update a category by ID
            ->name('categories.update')
            ->middleware(['auth:sanctum', 'role:admin,moderator']);

        Route::delete('/{id}', [CategoryController::class, 'destroy'])      // Remove a category by ID
            ->name('categories.destroy')
            ->middleware(['auth:sanctum', 'role:admin']);
    });


    /**
     *  Product CRUD operations
     */
    Route::prefix('products')->group(function () {

        Route::get('/', [ProductController::class, 'index'])        // Get all products
            ->name('products.index');
        Route::get('/{id}', [ProductController::class, 'show'])     // Get a product by ID
            ->name('products.show');
    });
});
