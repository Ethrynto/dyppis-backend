<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserService\UpdateAuthRoleRequest;
use App\Http\Resources\UserService\UserResource;
use App\Models\UserService\User;
use App\Utils\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthRoleController extends Controller
{

    /**
     *  Update a user role
     *
     *  @param UpdateAuthRoleRequest $request
     *  @param string $userId
     *  @return JsonResponse
     */
    public function update(UpdateAuthRoleRequest $request, string $userId): JsonResponse
    {
        $user = User::findOrFail($userId);

        $user->role = $request->role;
        $user->save();

        return ApiResponse::success([],
            'Role updated successfully.'
        );
    }
}
