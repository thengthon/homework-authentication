<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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

// Post
Route::get('/students', [PostController::class, 'index']);
Route::get('/students/{id}', [PostController::class, 'show']);

// User
Route::post('/users', [UserController::class, 'register']);
Route::post('/users', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    // Post
    Route::post('/students', [PostController::class, 'store']);
    Route::delete('/students/{id}', [PostController::class, 'destroy']);
    Route::put('/students/{id}', [PostController::class, 'update']);

    // User
    Route::post('/users', [UserController::class, 'logout']);
});