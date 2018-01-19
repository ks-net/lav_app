<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {

        Schema::defaultStringLength(191);

        /*
         * Blade Translations Capitalization Directives
         * for non-latin languages with utf-8 support
         */
        Blade::directive('lang_ucf', function ($s) { // capital 1st only
            return "<?php echo mb_strtoupper(mb_substr(trans($s), 0, 1)).mb_strtolower(mb_substr(trans($s), 1)); ?>";
        });

        Blade::directive('lang_ucw', function ($s) { // capital 1st character  of all words
            return "<?php echo mb_convert_case(trans($s), MB_CASE_TITLE, 'UTF-8'); ?>";
        });

        Blade::directive('lang_uc', function ($s) { // all capital
            return "<?php echo mb_convert_case(trans($s), MB_CASE_UPPER, 'UTF-8'); ?>";
        });

        Blade::directive('lang_lc', function ($s) { // all lower
            return "<?php echo mb_convert_case(trans($s), MB_CASE_LOWER, 'UTF-8'); ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
