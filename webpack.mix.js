let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.webpackConfig({
    resolve: {
        alias: {
            'fancybox': '@fancyapps/fancybox'  // relative to node_modules
        }
    }
});

mix.js('resources/assets/js/app.js', 'public/js')
        .js('resources/assets/js/ajax-postcreate.js', 'public/js')
        .sass('resources/assets/sass/app.scss', 'public/css');
/*   .styles([
 'resources/assets/css/lav_app.css'
 ], 'public/css/lav_app.css');
 */