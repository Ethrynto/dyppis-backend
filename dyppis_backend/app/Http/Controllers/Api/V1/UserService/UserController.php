<?php

namespace App\Http\Controllers\Api\V1\UserService;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserService\UserResource;
use App\Models\UserService\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     *  Get the user
     */
    public function index(Request $request)
    {
        //return UserResource::collection(User::paginate(10));
    }
}
