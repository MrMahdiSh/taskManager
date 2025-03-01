<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\VerifyRequest;
use App\Models\User;

class AuthController extends BaseController
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Register a new user",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful registration",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="We have an internal problem!")
     *         )
     *     )
     * )
     */
    public function register(RegisterRequest $request)
    {
        try {
            $token = $this->authService->register($request);
            return $this->responseWithToken($token);
        } catch (\Throwable $th) {
            return $this->response([], "We have an internal problem!", 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Login a user",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="We have an internal problem!")
     *         )
     *     )
     * )
     */
    public function login(LoginRequest $request)
    {
        try {
            $token = $this->authService->login($request);
            return $this->responseWithToken($token);
        } catch (\Throwable $th) {
            return $this->response([], "We have an internal problem!", 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/me",
     *     summary="Get authenticated user details",
     *     tags={"Authentication"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Authenticated user details",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="john@example.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     */
    public function me()
    {
        return auth()->user();
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Logout authenticated user",
     *     tags={"Authentication"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful logout",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Successfully logged out")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     */
    public function logout()
    {
        auth()->logout();
        return $this->response();
    }

    /**
     * @OA\Post(
     *     path="/api/refresh",
     *     summary="Refresh JWT token",
     *     tags={"Authentication"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Token refreshed successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     */
    public function refresh()
    {
        $token = JWTAuth::refresh();
        return $this->responseWithToken($token);
    }

    /**
     * @OA\Get(
     *     path="/api/verify",
     *     summary="Verify user email",
     *     tags={"Authentication"},
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="code",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Email verified successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Email verified successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=419,
     *         description="Invalid or expired verification link",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The verify link is expired!")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid verification code",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The sent code is not true may be you wanna HACK us :))")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="There is internal problem!")
     *         )
     *     )
     * )
     */
    public function verify(VerifyRequest $request)
    {
        if (!$request->hasValidSignature()) {
            return $this->response([], "The verify link is expired!", 419);
        }
        try {
            $user = User::findOrFail($request->input("id"));
            $status = $this->authService->verify($user, $request->input("code"));
            return $status ? $this->response() : $this->response([], "The sent code is not true may be you wanna HACK us :))");
        } catch (\Throwable $th) {
            return $this->response([], "There is internal problem!", 500);
        }
    }
}
