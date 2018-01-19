<?php

namespace App\Providers;

use App\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        $settings = Cache::remember('settings', 3600, function() {
                    return Setting::pluck('value', 'name')->all();
                });

        config()->set('settings', $settings);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
