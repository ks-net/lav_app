<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth')->only('index', 'update');
    }

    /**
     * Show the Index Page of Settings
     */
    public function index() {

        $settings = DB::table('settings')->orderBy('id', 'asc')->get();

        return view('admin.settings', ['settings' => $settings]);
    }

    /**
     * Update Settings
     */
    public function update(Request $request) {

        $settings = $request->except('_token', '_method');

        foreach ($settings as $key => $value) {
            Setting::where('name', $key)->update(['value' => $value]);
        }


        Cache::forget('settings');

        return redirect('admin/settings')->with('flash_message', __('general.The-Post') . ' ' . __('general.success-updated-message'));
    }

}
