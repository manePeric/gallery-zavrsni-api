<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleryController;
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
Route::get("galleries/{gallery}", [GalleryController::class, "show"]);
Route::post("/create", [GalleryController::class, "store"])->middleware("auth");
Route::put("galleries/{gallery}", [GalleryController::class, "update"]);
Route::delete("/galleries/{gallery}", [GalleryController::class, "destroy"]);

Route::post("login", [AuthController::class, "login"]);
Route::post("register", [AuthController::class, "register"]);
Route::get("my-gallery", [AuthController::class, "getActiveUser"])->middleware(
    "auth"
);
Route::post("logout", [AuthController::class, "logout"])->middleware("auth");