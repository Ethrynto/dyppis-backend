<?php

use App\Http\Controllers\Api\V1\UserService\UserController;
use Illuminate\Support\Facades\Route;


Route::get('test', [UserController::class, 'index']);
