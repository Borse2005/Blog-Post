<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/secret', [App\Http\Controllers\HomeController::class, 'secret'])->name('secret')->middleware('can:home.secret');
Route::resource('/post', PostController::class);

Route::get('/comment/{id}', [CommentController::class, 'index'])->name('index');
Route::get('/comment', [CommentController::class, 'store'])->name('store')->middleware('auth');


Route::get("post/tag/{tag}", [TagController::class, 'index'])->name('post.tag.index');
