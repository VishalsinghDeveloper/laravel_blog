<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use GuzzleHttp\Middleware;
use App\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['middleware' => 'guest'], function () {
    Route::post('/', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::get('register', [AuthController::class, 'register_view'])->name('register');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [PostController::class, 'post'])->name('home');
    Route::get('post', [PostController::class, 'index'])->name('post');
    Route::get('postedit/{id}', [PostController::class, 'edit'])->name('edit');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('post', [PostController::class, 'add_post'])->name('post');
    Route::put('postedit/{id}', [PostController::class, 'update'])->name('update');
    Route::get('postdelete/{id}', [PostController::class, 'destroy'])->name('delete');
});

Route::group(['middleware' => 'admin'], function () {
    Route::get('admin', [AdminController::class, 'show'])->name('show');
    Route::get('category', [AdminController::class, 'category'])->name('category');
    Route::post('category', [AdminController::class, 'addcategory'])->name('category');
    Route::put('edit/{id}', [AdminController::class, 'update'])->name('update');
    Route::get('edit/{id}', [AdminController::class, 'edit'])->name('update');
    Route::get('delete/{id}', [AdminController::class, 'destroy'])->name('delete');
    Route::put('pedit/{id}', [AdminController::class, 'postupdate'])->name('pupdate');
    Route::get('pedit/{id}', [AdminController::class, 'postedit'])->name('pupdate');
    Route::get('pdelete/{id}', [AdminController::class, 'Postdestroy'])->name('pdelete');
    Route::get('showcategory', [AdminController::class, 'showcategory'])->name('showcategory');
    Route::get('update&delete', [AdminController::class, 'update_delete'])->name('update&delete');
    Route::get('user', [AdminController::class, 'user'])->name('user');
});
