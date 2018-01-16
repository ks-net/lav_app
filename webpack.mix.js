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
       .js('resources/assets/js/admin.js', 'public/js')
       .sass('resources/assets/sass/app.scss', 'public/css')
       .sass('resources/assets/sass/admin.scss', 'public/css/admin.css');



//mix.copy('node_modules/font-awesome/fonts/', 'public/fonts/', false); // false = keep folder stracture no-flatten
//mix.styles('node_modules/font-awesome/css/font-awesome.min.css', 'public/css/font-awesome.min.css');
