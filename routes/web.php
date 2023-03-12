<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

// ************************** route authetification laravel ui ******************************
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

// ************************* route resource USERS ******************************
Route::resource('/users', App\Http\Controllers\UserController::class)-> except('index', 'create', 'store');

// ************************** route resource POSTS *****************************
Route::resource('/posts', App\Http\Controllers\PostController::class)->except('index', 'create', 'show' );

// ************************** route back-office admin *****************************
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin')->middleware('admin');

// ************************** route resource COMMENTS *****************************
Route::resource('/comments', App\Http\Controllers\CommentController::class)->except('index', 'create', 'show' );

// ************************** route back-office admin *****************************
Route::get('/search', [App\Http\Controllers\PostController::class, 'search'])->name('search');
