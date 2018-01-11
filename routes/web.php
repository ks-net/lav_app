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
use App\Media;

Auth::routes();


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post', 'PostController@index')->name('posthome');

Route::get('/post/list', 'PostController@listing')->name('postlist')->middleware('auth');

Route::get('/post/create', function () {
    $tags = Post::allTags();
    return view('post-create', compact('tags'));
})->middleware('auth');

Route::post('/post/create', 'PostController@create')->name('postcreate')->middleware('auth');

Route::get('post/{seotitle}', 'PostController@view')->name('postsingle');


Route::get('media/', 'MediaController@index')->name('medialist')->middleware('auth');

Route::post('media/add', 'MediaController@add')->name('mediaadd')->middleware('auth');

Route::get('media/add', function () {
    $tags = Media::allTags();
    return view('media-add', compact('tags'));
})->middleware('auth');


/******************************
 * Admin Rooutes
 *
********************************/
Route::group(['prefix' => 'admin'], function()
{




});

