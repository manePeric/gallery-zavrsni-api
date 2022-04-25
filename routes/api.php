<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware("auth:sanctum")->get("/user", function (Request $request) {
    return $request->user;
});

Route::get("/galleries", [GalleryController::class, "index"]);
Route::get("/galleries/{id}", [GalleryController::class, "show"]);
Route::post("/galleries", [GalleryController::class, "store"])->middleware(
    "auth:api"
);
Route::put("galleries/{id", [GalleryController::class, "update"])->middleware(
    "auth:api"
);
Route::delete("galleries/{id}", [
    GalleryController::class,
    "destroy",
])->middleware("auth:api");

Route::post("/login", [AuthController::class, "login"]);
Route::post("/register", [AuthController::class, "register"]);
Route::get("/my-gallery", [AuthController::class, "getActiveUser"])->middleware(
    "auth:api"
);
Route::post("/logout", [AuthController::class, "logout"])->middleware(
    "auth:api"
);

Route::post("/galleries/{id}/comments", [
    CommentController::class,
    "store",
])->middleware("auth:api");

Route::post("/galleries/{id}/comments", [CommentController::class, "index"]);