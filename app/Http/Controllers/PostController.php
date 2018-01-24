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
//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
//use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class PostController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth')->only('create', 'edit', 'update', 'listing', 'delete', 'deleteMany');
    }

    /**
     * Show the Index Page of Posts
     */
    public function index() {
        $currentPage = Input::get('page') ? Input::get('page') : '1';
        $posts = Cache::remember('posts-index' . $currentPage, config('settings.cachetime'), function() {
                    return Post::where('active', '1')->orderBy('id', 'desc')->paginate(config('settings.artlistpagin'));
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

        $tags = Cache::remember('posttags' . $seotitle, config('settings.cachetime'), function() use ($post) {
                    return $post->tags;
                });

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
        $post->metatitle = $request->metatitle;
        $post->metakeywords = $request->metakeywords;
        $post->metadesc = $request->metadesc;

        /*
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
            $post->medium_img = 'storage/media/postimages/' . $post->id . '/' . $costumname . '_medium_img.jpg';
            $post->thumb_img = 'storage/media/postimages/' . $post->id . '/' . $costumname . '_thumb_img.jpg';
        }

        // now after post got an id.. grab tags from the request for this post->id
        $post->tag(explode(',', $request->tags)); // tag untag retag detag from Cviebrock\EloquentTaggable\Taggable

        $post->save(); // finally save all other data.. tags images etc..

        Cache::flush();

        return redirect('admin/post/list')->with('flash_message_success', __('common.post_success_saved_message'));
    }

    /**
     * Edit Post
     */
    public function edit($id) {
        $post = Post::findOrFail($id);

        $this->authorize('edit', $post);

        //$tagService = app(\Cviebrock\EloquentTaggable\Services\TagService::class);
        //$modeltags = $tagService->getAllTags(); // all tags from all models for use in selectize
        $modeltags = Post::allTags(); // all tags of this model(Post::) for use in selectize
        $tags = $post->tags; // already saved tags for this post id
        return view('post.admin.edit')->with('post', $post)->with('tags', $tags)->with('modeltags', $modeltags);
    }

    /**
     * updatePost
     */
    public function update(UpdatePostRequest $request) {
        $post = Post::findOrFail($request->id);

//$this->authorize('update' , $post);

        if (Gate::denies('update', $post)) {
            return back()->with('flash_message_error', __('common.NOT_AUTHORIZED'));
        } else {

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
                $post->medium_img = 'storage/media/postimages/' . $post->id . '/' . $costumname . '_medium_img.jpg';
                $post->thumb_img = 'storage/media/postimages/' . $post->id . '/' . $costumname . '_thumb_img.jpg';
            }

            $post->retag(explode(',', $request->tags)); // tag untag retag detag from Cviebrock\EloquentTaggable\Taggable

            $post->update($request->all());

            Cache::flush();

            return redirect('admin/post/list')->with('flash_message_success', __('common.post_success_updated_message'));
        }
    }

    /**
     * Delete Post
     */
    public function delete($id) {
        $post = Post::findOrFail($id);
        Storage::disk('public')->deleteDirectory('media/postimages/' . $id);
        // tag untag retag detag from Cviebrock\EloquentTaggable\Taggable
        //remove tags individually with untag() or entirely with detag()
        $post->detag();
        $post->delete();

        Cache::flush();

        return back()->with('flash_message_success', __('common.post_delete_message'));
    }

    /**
     * Delete all checked Posts
     */
    public function deleteMany(Request $request) {
        if ($request->input('deletechecked')) {
            $checked = $request->input('deletechecked', []); //get array [] of all checked inputs
            $posts = Post::whereIn('id', $checked);

            $postids = $request->input('deletechecked');
            $count = count($checked);
            // first delete all relative files , tags etc..
            foreach ($postids as $postid) {
                $post = Post::where('id', $postid)->first(); // first() and not get() for detag method to work
                $post->detag();
                Storage::disk('public')->deleteDirectory('media/postimages/' . $postid);
            }

            $posts->delete(); // finally remove checked posts
            return back()->with('flash_message_success', __('common.post_delete_many_message', ['count' => $count]));
        } else {
            return back()->with('flash_message_warning', __('common.post_none_checked_message'));
        }
    }

    /**
     * Search Posts
     */
    public function search(Request $request) {
        //$ids = Post::search($request->search)->get()->pluck('id'); // scout search
        //$posts = Post::whereIn('id', $ids)->sortable()->paginate(config('setings.panellistpagin'));// scout search and shortable
        $posts = Post::where('title', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('sortdesc', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('postbody', 'LIKE', '%' . $request->search . '%')
                        ->sortable('id')->paginate(config('setings.panellistpagin'));

        $search = $request->search;

        return view('post.admin.list')->withPosts($posts)->with('search', $search); // rendering sortable  pagination
    }

}
