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
use Validator;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Session;
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
        $this->middleware('auth')->except('index', 'view', 'publicSearchPosts');
    }

    /**
     * Show the Index Page of Posts .. Public
     */
    public function index() {
        $currentPage = Input::get('page') ? Input::get('page') : '1';
        $posts = Cache::remember('posts-index' . $currentPage, config('settings.cachetime'), function() {
                    return Post::where('active', '1')->orderBy('id', 'desc')->paginate(config('settings.public_pagination'));
                });

        return view('post.index', ['posts' => $posts]);
    }

    /**
     * Display Single Post Page ... Public
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

        return view('post.view')->with('post', $post)->with('previous', $previous)->with('next', $next)->with('tags', $tags);
    }

    /* ---------------------------------------------
     * Administrator Functions
     * Require Authentication and(or) Authorization
      --------------------------------------- */

    /**
     * Show  List Page of Posts .. Admin
     * with sortable table
     */
    public function listing(Post $post) {
        //$this->authorize('listing' , $post);
        if (Gate::denies('listing', $post)) {
            return back()->with('flash_message_error', __('common.NOT_AUTHORIZED'));
        }

        $posts = $post->sortable('id')->paginate(config('settings.admin_pagination'));
        return view('post.admin.list')->withPosts($posts); // rendering sortable  pagination
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
         * $post->order = $request->order;
          $post->active = $request->active;
         */

        //$this->authorize('create' , $post);
        if (Gate::denies('create', $post)) {
            return back()->with('flash_message_error', __('common.NOT_AUTHORIZED'));
        }

        $post->save(); // First save post once...  to get an id

        $this->postImages($request, $post);

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

        //$this->authorize('edit' , $post);
        if (Gate::denies('edit', $post)) {
            return back()->with('flash_message_error', __('common.NOT_AUTHORIZED'));
        }

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
        }

        $this->postImages($request, $post);

        $post->retag(explode(',', $request->tags)); // tag untag retag detag from Cviebrock\EloquentTaggable\Taggable
        $post->update($request->all());

        Cache::flush();

        return redirect('admin/post/list')->with('flash_message_success', __('common.post_success_updated_message'));
    }

    /**
     * Delete Post
     */
    public function delete($id) {
        $post = Post::findOrFail($id);

        //$this->authorize('delete' , $post);
        if (Gate::denies('delete', $post)) {
            return back()->with('flash_message_error', __('common.NOT_AUTHORIZED'));
        }


        Storage::disk('public')->deleteDirectory('media/postimages/' . $id);
        // tag untag retag detag from Cviebrock\EloquentTaggable\Taggable
        //remove tags individually with untag('anytag') or entirely with detag()
        $post->detag();
        $post->delete();

        Cache::flush();

        return back()->with('flash_message_success', __('common.post_delete_message'));
    }

    /**
     * Delete all checked Posts
     */
    public function deleteMany(Request $request) {

        if (!$request->input('deletechecked')) {
            return back()->with('flash_message_warning', __('common.post_none_checked_message'));
        }

        $checked = $request->input('deletechecked', []); //get array [] of all checked inputs
        $posts = Post::whereIn('id', $checked);


        //$this->authorize('deleteMany' , $post);
        if (Gate::denies('deleteMany', Post::class)) {
            return back()->with('flash_message_error', __('common.NOT_AUTHORIZED'));
        }


        $postids = $request->input('deletechecked');
        $count = count($checked);
        // first delete all relative files , remove relations with tags etc..
        foreach ($postids as $postid) {
            $post = Post::where('id', $postid)->first(); // first() and not get() for detag method to work
            $post->detag();
            Storage::disk('public')->deleteDirectory('media/postimages/' . $postid);
        }

        $posts->delete(); // finally remove checked posts
        return back()->with('flash_message_success', __('common.post_delete_many_message', ['count' => $count]));
    }

    /**
     * Upload update Post Images
     */
    public function postImages($request, $post) {


        //$this->authorize('postImages' , $post);
        if (Gate::denies('postImages', Post::class)) {
            return back()->with('flash_message_error', __('common.NOT_AUTHORIZED_UPLOAD'));
        }


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
    }

    /**
     * Reorder Posts .. Ajax
     */
    public function reorder(Request $request) {

        //$this->authorize('reorder' , $post);
        if (Gate::denies('reorder', Post::class)) {
            return response()->json(['error' => __('common.NOT_AUTHORIZED')]);
        }

        $validator = Validator::make($request->all(), [
                    'order' => 'required|between:-999,999|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $post = Post::findOrFail($request->id);
        $post->where('id', $request->id)->update(['order' => $request->order]);

        return response()->json(['success' => __('common.success_updated_message')]);
    }

    /**
     * Enable - Disable Posts .. Ajax
     */
    public function activate(Request $request) {

        //$this->authorize('activate' , $post);
        if (Gate::denies('activate', Post::class)) {
            return response()->json(['error' => __('common.NOT_AUTHORIZED')]);
        }

        $post = Post::findOrFail($request->id);
        $post->where('id', $request->id)->update(['active' => $request->active]);

        return response()->json(['success' => __('common.success_updated_message'),'state' => $request->active]);
    }

    /**
     * Search Posts
     */
    public function adminSearchPosts(Request $request) {
        //$this->authorize('adminSearchPosts' , $post);
        if (Gate::denies('adminSearchPosts', Post::class)) {
            return back()->with('flash_message_error', __('common.NOT_AUTHORIZED'));
        }

        //$ids = Post::search($request->search)->get()->pluck('id'); // scout search
        //$posts = Post::whereIn('id', $ids)->sortable()->paginate(config('setings.panellistpagin'));// scout search and shortable WorkAround
        $posts = Post::where('title', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('sortdesc', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('postbody', 'LIKE', '%' . $request->search . '%')
                        ->sortable('id')->paginate(config('setings.admin_pagination'));

        $search = $request->search;

        return view('post.admin.list')->withPosts($posts)->with('search', $search); // rendering sortable  pagination
    }

}
