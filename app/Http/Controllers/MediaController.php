<?php

namespace App\Http\Controllers;

use App\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\CreateMediaRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class MediaController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show  List Page of Posts
     * with sortable table
     */
    public function index(Media $media) {
        $medias = $media->sortable('id')->paginate(config('settings.panellistpagin'));

        return view('media.admin.index')->withMedias($medias);
    }

    /**
     * Add New Media
     */
    public function add(CreateMediaRequest $request) {
        // data validation done at App\Http\Requests\CreateMediaRequest
        $media = new Media;
        $media->name = $request->name;
        $media->desc = $request->desc;
        $media->slug = $request->slug;
        //$media->slug = $request->slug;
        // $media->order = $request->order;
        // $media->active = $request->active;
        //
        //save once to get id and slug
        $media->save();

        $file = $request->file('image');

        $filename = 'image_' . $media->slug . '_ORIGINAL.' . $file->getClientOriginalExtension();

        Storage::disk('public')->put('media/images/ORIGINAL/' . $filename, file_get_contents($file));
        Storage::disk('public')->makeDirectory('media/images/medium');
        Storage::disk('public')->makeDirectory('media/images/thumb');
        //  Storage::disk('public')->makeDirectory('media/images');

        $img = 'storage/media/images/ORIGINAL/' . $filename;
        $costumname = 'image_' . $media->slug;

        Image::make($img)->resize(config('settings.media_full_img_width'), null, function ($constraint) {
            $constraint->aspectRatio();
        })->save('storage/media/images/' . $costumname . '.jpg', 90);

        Image::make($img)->resize(config('settings.media_medium_img_width'), null, function ($constraint) {
            $constraint->aspectRatio();
        })->save('storage/media/images/medium/' . $costumname . '_medium_img.jpg', 90);

        Image::make($img)->fit(config('settings.media_thumb_img_width'), config('settings.media_thumb_img_height'))
                ->save('storage/media/images/thumb/' . $costumname . '_thumb_img.jpg', 90);

        $media->image_original = 'storage/media/images/ORIGINAL/' . $filename;
        $media->image = 'storage/media/images/' . $costumname . '.jpg';
        $media->image_medium = 'storage/media/images/medium/' . $costumname . '_medium_img.jpg';
        $media->image_thumb = 'storage/media/images/thumb/' . $costumname . '_thumb_img.jpg';


        // now after post got  an id grab tags from the request for this post->id
        $media->tag(explode(',', $request->tags));

        $media->save(); // finaly save all

        Cache::flush();

        return redirect()->route('adminmedialist')->with('flash_message', __('general.The-Image') .' '. __('general.success-saved-message'));
    }

    /**
     * Delete Media
     */
    public function delete($id) {

        $media = Media::findOrFail($id);
        File::delete($media->image, $media->image_medium, $media->image_thumb, $media->image_original);
        $media->delete();
        //Cache::flush();
        return back()->with('flash_message', __('general.media-delete-message'));
    }

}
