<?php

namespace App\Utils;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    /**
     *  Returns a successful response to the resource creation.
     *
     *  @param mixed $data
     *  @param string $message
     *  @return JsonResponse
     */
    public static function created(mixed $data, string $message = 'Resource created successfully.'): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], 201);
    }

    /**
     *  Returns a successful response to a resource update.
     *
     *  @param mixed $data
     *  @param string $message
     *  @return JsonResponse
     */
    public static function updated(mixed $data, string $message = 'Resource updated successfully.'): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], 200);
    }

    /**
     *  Returns a successful response to the deletion of the resource.
     *
     *  @param string $message
     *  @return JsonResponse
     */
    public static function deleted(string $message = 'Resource deleted successfully.'): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
        ], 200);
    }

    /**
     *  Returns a successful response to a data retrieval.
     *
     *  @param mixed $data
     *  @param string $message
     *  @return JsonResponse
     */
    public static function success(mixed $data, string $message = 'Operation successful.'): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], 200);
    }

    /**
     *  Returns an erroneous answer.
     *
     *  @param string $message
     *  @param int $code
     *  @param mixed|null $errors
     *  @return JsonResponse
     */
    public static function error(string $message = 'An error occurred.', int $code = 400, mixed $errors = null): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors
        ], $code);
    }

}
