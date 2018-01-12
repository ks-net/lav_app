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
use App\Post;
use App\Media;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post', 'PostController@index')->name('posthome');

Route::get('post/{seotitle}', 'PostController@view')->name('postsingle');


/* * ****************************
 * Admin Routes
 *
 * ****************************** */
Route::group(['prefix' => 'admin'], function() {

    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin')->middleware('auth');

    // Admin post routes
    Route::get('/post/list', 'PostController@listing')->name('adminpostlist')->middleware('auth');
    Route::post('/post/create', 'PostController@create')->name('adminpostcreate')->middleware('auth');

    Route::get('/post/create', function () {
        $tags = Post::allTags();
        return view('post.admin.create', compact('tags'));
    })->middleware('auth');

    Route::get('/post/delete/{id}', ['as' => 'postdelete', 'uses' => 'PostController@delete'])->middleware('auth');


// Admin media routes
    Route::get('media/', 'MediaController@index')->name('adminmedialist')->middleware('auth');
    Route::post('media/add', 'MediaController@add')->name('adminmediaadd')->middleware('auth');

    Route::get('media/add', function () {
        $tags = Media::allTags();
        return view('media.admin.add', compact('tags'));
    })->middleware('auth');

    Route::get('/media/delete/{id}', ['as' => 'adminmediadelete', 'uses' => 'MediaController@delete'])->middleware('auth');

    Route::get('media/modal', function () {
        $medias = Media::where('active', 1)->paginate(5);

        return view('media.admin.modal')->with(['medias' => $medias]);
    })->middleware('auth');
});

