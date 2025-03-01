<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    /**
     * Generates a standardized JSON response.
     *
     * @param array $data The data to include in the response.
     * @param string $message The message to include in the response.
     * @param int $status The HTTP status code for the response.
     * @return \Illuminate\Http\JsonResponse Returns a JSON response with the provided data, message, and status code.
     */
    public function response($data = [], $message = "Operation was successfully!", $status = 200)
    {
        return response()->json([
            "message" => $message, // Response message.
            "data" => $data,      // Response data.
            "status_code" => $status // HTTP status code.
        ], $status);
    }

    /**
     * Generates a JSON response with a JWT token.
     *
     * @param string $token The JWT token to include in the response.
     * @return \Illuminate\Http\JsonResponse Returns a JSON response with the token, token type, and expiration time.
     */
    public function responseWithToken($token)
    {
        return response()->json([
            "token" => $token, // The JWT token.
            "token_type" => "bearer", // The type of token (always "bearer" for JWT).
            "token_expires_in" => Auth::guard()->factory()->getTTL() * 60 // Token expiration time in seconds.
        ], 200);
    }
}
