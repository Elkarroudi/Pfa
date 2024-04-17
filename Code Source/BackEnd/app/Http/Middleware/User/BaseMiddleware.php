<?php

namespace App\Http\Middleware\User;

use Illuminate\Http\JsonResponse;

class BaseMiddleware
{
    function responseWithErrors($message): JsonResponse
    {
        return response()->json([
            'status' => false,
            'errors' => $message,
        ]);
    }
}
