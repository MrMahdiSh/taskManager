<?php

use App\Http\Controllers\api\v1\TaskController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SampleWorkController;
use App\Http\Controllers\AuthVSauth;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\SessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use WpOrg\Requests\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get("/login", [AuthController::class, "login"])->name("login");

Route::get("/register", [AuthController::class, "register"])->name("register");

Route::get("/verify", [AuthController::class, "verify"])->name("verify");

Route::middleware("auth:api")->group(function () {

    Route::get("/me", [AuthController::class, "me"]);

    Route::get("/refresh", [AuthController::class, "refresh"]);

    Route::get("/logout", [AuthController::class, "logout"]);
});

Route::prefix('v1')->group(function () {

    Route::get("/tasks", [TaskController::class, "index"]);

    Route::post("/tasks", [TaskController::class, "store"]);

    Route::get("/tasks/{id}", [TaskController::class, "show"]);

    Route::put("/tasks/{id}", [TaskController::class, "update"]);

    Route::delete("/tasks/{id}", [TaskController::class, "destroy"]);

    Route::apiResource('goals', GoalController::class);

    Route::apiResource('days', DayController::class);

    Route::apiResource('routines', RoutineController::class);

    Route::apiResource('sessions', SessionController::class);
});
