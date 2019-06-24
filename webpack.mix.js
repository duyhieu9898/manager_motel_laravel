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

mix.styles([
    'resources/css/category.css',
    'resources/css/detail-posts.css',
    'resources/css/footer.css',
    'resources/css/header.css',
    'resources/css/index.css',
    'resources/css/login.css',
    'resources/css/nav.css',
], 'public/css/style.css');
mix.js('resources/js/app.js', 'public/js/app.js')