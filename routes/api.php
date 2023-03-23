<?php

use App\Http\Controllers\Api\ApiadminController;
use App\Http\Controllers\Api\ApiauthController;
use App\Http\Controllers\Api\ApipostController;
use GuzzleHttp\Middleware;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::get('category', [ApiadminController::class, 'index']);
    Route::get('category/{id}', [ApiadminController::class, 'show']);
    Route::post('category', [ApiadminController::class, 'addCategory']);
    Route::put('category/{id}', [ApiadminController::class, 'update']);
    Route::delete('category/{id}', [ApiadminController::class, 'destroy']);
    Route::get('user', [ApiadminController::class, 'user']);
    Route::get('post', [ApipostController::class, 'index']);
    Route::post('post', [ApipostController::class, 'add_post']);
    Route::post('post/{id}', [ApipostController::class, 'update']);
    Route::delete('post/{id}', [ApipostController::class, 'destroy']);

});


Route::post('login', [ApiauthController::class, 'login']);
Route::post('register', [ApiauthController::class, 'register']);
Route::post('logout', [ApiauthController::class, 'logout']);
