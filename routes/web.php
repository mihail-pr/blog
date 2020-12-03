<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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
Route::get('/', 'App\Http\Controllers\PostController@index');
Route::get('/home', ['as' => 'home', 'uses' => 'App\Http\Controllers\PostController@index']);

//authentication
// Route::resource('auth', 'Auth\AuthController');
// Route::resource('password', 'Auth\PasswordController');
Route::get('/logout', 'App\Http\Controllers\UserController@logout');
Route::group(['prefix' => 'auth'], function () {
    Auth::routes();
});

// check for logged in user
Route::middleware(['auth'])->group(function () {
    // show new post form
    Route::get('new-post', 'App\Http\Controllers\PostController@create');
    // save new post
    Route::post('new-post', 'App\Http\Controllers\PostController@store');
    // edit post form
    Route::get('edit/{slug}', 'App\Http\Controllers\PostController@edit');
    // update post
    Route::post('update', 'App\Http\Controllers\PostController@update');
    // delete post
    Route::get('delete/{id}', 'App\Http\Controllers\PostController@destroy');
    // display user's all posts
    Route::get('my-all-posts', 'App\Http\Controllers\UserController@user_posts_all');
    // display user's drafts
    Route::get('my-drafts', 'App\Http\Controllers\UserController@user_posts_draft');
    // add comment
    Route::post('comment/add', 'App\Http\Controllers\CommentController@store');
    // delete comment
    Route::post('comment/delete/{id}', 'App\Http\Controllers\CommentController@distroy');
});

//users profile
Route::get('user/{id}', 'App\Http\Controllers\UserController@profile')->where('id', '[0-9]+');
// display list of posts
Route::get('user/{id}/posts', 'App\Http\Controllers\UserController@user_posts')->where('id', '[0-9]+');
// display single post
Route::get('/{slug}', ['as' => 'post', 'uses' => 'App\Http\Controllers\PostController@show'])->where('slug', '[A-Za-z0-9-_]+');
