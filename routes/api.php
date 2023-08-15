<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Blogs
Route::group(['prefix'=> 'v1', 'namespace'=>'App\Http\Controllers\Api\V1'], function () {
    //Token
    Route::post('/checkToken',[\App\Http\Controllers\API\V1\TokenController::class, "check"]);
    //Authentification
    Route::apiResource('users', \App\Http\Controllers\Api\V1\AuthenticationController::class);
    Route::post('/register',[\App\Http\Controllers\API\V1\AuthenticationController::class, "register"]);
    Route::post('/login',[\App\Http\Controllers\API\V1\AuthenticationController::class, "login"]);
    Route::post('/logout',[\App\Http\Controllers\API\V1\AuthenticationController::class, "logout"]);
    //Blog
    Route::apiResource('blogs', \App\Http\Controllers\Api\V1\BlogController::class);
    Route::post('create', [\App\Http\Controllers\API\V1\BlogController::class, "create"]);
    Route::put('/update/{id}', [\App\Http\Controllers\API\V1\BlogController::class, "update"]);
});
