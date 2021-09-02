const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();


mix.scripts([
    'node_modules/plugins/jquery/jquery.min.js',
    'node_modules/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'node_modules/plugins/datatables/jquery.dataTables.min.js',

], 'public/js/all.min.js');

