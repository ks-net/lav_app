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
use Illuminate\Support\Facades\Input;
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
 * ****************************** */
Route::group(['prefix' => 'admin'], function() {

    Route::get('/', 'AdminDashboardController@index')->name('admin')->middleware('auth');

    Route::get('/settings', 'SettingController@index')->name('adminsettings')->middleware('auth');
    Route::put('/settings/update', 'SettingController@update')->name('adminsettingsupdate')->middleware('auth');


    // Admin post routes
    Route::get('/post/list', 'PostController@listing')->name('adminpostlist')->middleware('auth');
    Route::post('/post/create', 'PostController@create')->name('adminpostcreate')->middleware('auth');

    Route::get('/post/create', function () {
        $tags = Post::allTags();
        return view('post.admin.create', compact('tags'));
    })->name('adminpostform')->middleware('auth');

    Route::get('/post/edit/{id}', 'PostController@edit')->name('adminpostedit')->middleware('auth');

    Route::put('/post/update/{id}', 'PostController@update')->name('adminpostupdate')->middleware('auth');

    Route::delete('/post/delete/{id}', ['as' => 'adminpostdelete', 'uses' => 'PostController@delete'])->middleware('auth');

    Route::get('/post/search', ['as' => 'adminpostsearch', 'uses' => 'PostController@search'])->middleware('auth');

    // Admin media routes
    Route::get('media/', 'MediaController@index')->name('adminmedialist')->middleware('auth');
    Route::post('media/add', 'MediaController@add')->name('adminmediaadd')->middleware('auth');

    Route::get('media/add', function () {
        $tags = Media::allTags();
        return view('media.admin.add', compact('tags'));
    })->name('adminmediaform')->middleware('auth');

    Route::delete('/media/delete/{id}', ['as' => 'adminmediadelete', 'uses' => 'MediaController@delete'])->middleware('auth');

    Route::get('media/modal', function () {
        $medias = Media::where('active', 1)->paginate(5);

        return view('media.admin.modal')->with(['medias' => $medias]);
    })->middleware('auth');
});

