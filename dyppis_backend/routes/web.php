<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/login', function () {
    return view('admin.login');
})
    ->name('admin.login')
    ->middleware('guest');

Route::prefix('admin')->group(function () {

    Route::get('dashboard', function () {
        return view('admin.dashboard');
    });


    /**
     *  User management
     */
    Route::prefix('users')->group(function () {

        Route::get('/', function () {
            return view('admin.users.index');
        })->name('admin.users.index');

        Route::get('/{id}', function () {
            return view('admin.users.show');
        })->name('admin.users.show');
    });


    /**
     *  Platforms management
     */
    Route::prefix('platforms')->group(function () {

        Route::get('/', [\App\Http\Controllers\View\ProductService\PlatformController::class, 'index'])
            ->name('admin.platforms.index');

        Route::get('/show/{id}', function () {
            return view('admin.platforms.show');
        })->name('admin.platforms.show');

        Route::get('/create', [\App\Http\Controllers\View\ProductService\PlatformController::class, 'create'])->name('admin.platforms.create');
    })
        ->middleware('auth:sanctum'); // Ensure authentication for platform routes

    /**
     *  Categories management
     */
    Route::prefix('categories')->group(function () {

        Route::get('/', function () {
            return view('admin.categories.index');
        })->name('admin.categories.index');

        Route::get('/{id}', function () {
            return view('admin.categories.show');
        })->name('admin.categories.show');
    });

    /**
     *  Platforms management
     */
    Route::prefix('deliveries')->group(function () {

        Route::get('/', function () {
            return view('admin.deliveries.index');
        })->name('admin.deliveries.index');

        Route::get('/{id}', function () {
            return view('admin.deliveries.show');
        })->name('admin.deliveries.show');
    });


    /**
     *  Products management
     */
    Route::prefix('products')->group(function () {

        Route::get('/', function () {
            return view('admin.products.index');
        })->name('admin.products.index');

        Route::get('/{id}', function () {
            return view('admin.products.show');
        })->name('admin.products.show');
    });
})->middleware('checkAdminAuth');
