<?php

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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use App\Post;


Auth::routes();


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post', 'PostController@index')->name('posts index');

Route::get('/post/list', 'PostController@listing')->name('posts list')->middleware('auth');

Route::get('/post/create', function () {
    $tags = Post::allTagModels();
    return view('post-create', compact('tags'));
})->middleware('auth');

Route::post('/post/create', 'PostController@create')->name('Posting New Post')->middleware('auth');

Route::get('post/{seotitle}', 'PostController@view')->name('Single Post View');

Route::get('post/tag/{tag}', 'PostController@index')->name('Posts with tags page');

/******************************
 * Admin Rooutes
 *
********************************/
Route::group(['prefix' => 'admin'], function()
{




});

