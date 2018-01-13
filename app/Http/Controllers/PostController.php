<?php

/*
 *  File: BlogController.php part-of-project: lav_app encoding: UTF-8
 *  Last Modified at 28 Δεκ 2017 11:20:42 μμ.
 *  NOTE: COMMERCIAL LICENSE.. !
 *  Copyright 2017 KSNET.
 *  YOU ARE NOT ALLOWED TO USE ANYWHERE .. THIS CODE OR PORTIONS OF IT..!
 *  VARIATIONS, ADAPTATIONS, ADDITIONS, OR INCLUSIONS ARE ALSO FORBIDDEN !
 *  This software uses Lavarel PHPframework!
 */

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Session;
//use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class PostController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth')->only('create', 'edit', 'update', 'listing', 'delete');
    }

    /**
     * Show the Index Page of Posts
     */
    public function index() {
        $currentPage = Input::get('page') ? Input::get('page') : '1';
        $posts = Cache::remember('posts-index' . $currentPage, config('settings.cachetime'), function() {
                    return DB::table('posts')->where('active', '1')->orderBy('id', 'desc')->paginate(config('settings.artlistpagin'));
                });

        return view('post.index', ['posts' => $posts]);
    }

    /**
     * Show  List Page of Posts
     * with sortable table
     */
    public function listing(Post $post) {
        $posts = $post->sortable('id')->paginate(config('settings.panellistpagin'));
        return view('post.admin.list')->withPosts($posts); // rendering sortable  pagination
    }

    /**
     * Display Single Post Page
     */
    public function view($seotitle) {
        $post = Cache::remember('post' . $seotitle, config('settings.cachetime'), function() use ($seotitle) {
                    return Post::where('seotitle', $seotitle)->where('active', '1')->first() ?? abort(404);
                });

        $postid = $post->id;

        $previous = Cache::remember('postprevious' . $seotitle, config('settings.cachetime'), function() use ($postid) {
                    return Post::where('id', '>', $postid)->where('active', '1')->select('title', 'seotitle')->orderBy('id', 'asc')->first();
                });
        $next = Cache::remember('postnext' . $seotitle, config('settings.cachetime'), function() use ($postid) {
                    return Post::where('id', '<', $postid)->where('active', '1')->select('title', 'seotitle')->orderBy('id', 'desc')->first();
                });

        $tags = $post->tags;
        return view('post.single')->with('post', $post)->with('previous', $previous)->with('next', $next)->with('tags', $tags);
    }

    /**
     * Add New Post
     */
    public function create(CreatePostRequest $request) {
        // data validation done at App\Http\Requests\CreatePostRequest
        $post = new Post;
        $post->title = $request->title;
        $post->sortdesc = $request->sortdesc;
        $post->postbody = $request->postbody;
        /*         $data->metatitle = $request->metatitle;
          $data->metakeywords = $request->metakeywords;
          $data->metadesc = $request->metadesc;
          $data->tags = $request->tags;
          $data->seotitle = $request->seotitle;
          $data->active = $request->active;
         */

        $post->save(); // First save post once...  to get an id

        if ($request->hasfile('main_img')) {
            $file = $request->file('main_img');
            // Storage::makeDirectory('storage/media/postimages/' . $post->id);


            $filename = 'post_' . $post->id . '_ORIGINAL.' . $file->getClientOriginalExtension();

            Storage::disk('public')->put('media/postimages/' . $post->id . '/' . $filename, file_get_contents($file));
            // $file->move('storage/media/postimages/' . $post->id . '/', $filename);
            $img = 'storage/media/postimages/' . $post->id . '/' . $filename;
            $costumname = 'post_' . $post->id;

            Image::make($img)->fit(config('settings.post_main_img_width'), config('settings.post_main_img_height'))
                    ->save('storage/media/postimages/' . $post->id . '/' . $costumname . '_main_img.jpg', 90);

            Image::make($img)->fit(config('settings.post_medium_img_width'), config('settings.post_medium_img_height'))
                    ->save('storage/media/postimages/' . $post->id . '/' . $costumname . '_medium_img.jpg', 90);

            Image::make($img)->fit(config('settings.post_thumb_img_width'), config('settings.post_thumb_img_height'))
                    ->save('storage/media/postimages/' . $post->id . '/' . $costumname . '_thumb_img.jpg', 90);
            /*
              Image::make($img)->resize(config('settings.post_medium_img_width'), null, function ($constraint) {
              $constraint->aspectRatio();
              })->save('storage/media/postimages/' . $post->id . '/' . $costumname . '_medium_img.jpg', 90);

              Image::make($img)->resize(config('settings.post_thumb_img_width'), null, function ($constraint) {
              $constraint->aspectRatio();
              })->save('storage/media/postimages/' . $post->id . '/' . $costumname . '_thumb_img.jpg', 90);
             */

            $post->main_img = 'storage/media/postimages/' . $post->id . '/' . $costumname . '_main_img.jpg';
        }

        // now after post got an id.. grab tags from the request for this post->id
        $post->tag(explode(',', $request->tags)); // tag untag retag detag from Cviebrock\EloquentTaggable\Taggable

        $post->save(); // finally save all other data.. tags images etc..

        Cache::flush();

        return redirect('admin/post/list')->with('flash_message', __('general.The-Post') . ' ' . __('general.success-saved-message'));
    }

    /**
     * Edit Post
     */
    public function edit($id) {
        $post = Post::findOrFail($id);
        $modeltags = Post::allTags(); // all model tags for use in selectize
        $tags = $post->tags; // already saved tags for this post id
        return view('post.admin.edit')->with('post', $post)->with('tags', $tags)->with('modeltags', $modeltags);
    }

    /**
     * updatePost
     */
    public function update(Request $request, $id) {
        $post = Post::findOrFail($id);
        $post->retag(explode(',', $request->tags)); // tag untag retag detag from Cviebrock\EloquentTaggable\Taggable
        $post->update($request->all());

        Cache::flush();

        return redirect('admin/post/list')->with('flash_message', __('general.The-Post') . ' ' . __('general.success-saved-message'));
    }

    /**
     * Delete Post
     */
    public function delete($id) {
        $post = Post::findOrFail($id);
        Storage::disk('public')->deleteDirectory('media/postimages/' . $id);
        $post->delete();

        Cache::flush();

        return back()->with('flash_message', __('general.The-Post') . ' ' . __('general.success-saved-message'));
    }

}
