<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/secret', [App\Http\Controllers\HomeController::class, 'secret'])->name('secret')->middleware('can:home.secret');
Route::resource('post', PostController::class);
Route::resource('/user', UserController::class)->only(['show','edit','update']);

Route::get("post/tag/{tag}", [TagController::class, 'index'])->name('post.tag.index');
Route::resource('post.comment', PostCommentController::class)->only(['store']);

Auth::routes();
