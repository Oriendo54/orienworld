const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/about.js', 'public/js')
    .js('resources/js/contact.js', 'public/js')
    .js('resources/js/home.js', 'public/js')
    .js('resources/js/orienworld.js', 'public/js')
    .js('resources/js/portfolio.js', 'public/js')
    .js('resources/js/sidebar.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .postCss('resources/css/normalize.css', 'public/css')
    .postCss('resources/css/style.css', 'public/css');

if (mix.inProduction()) {
    mix.version();
}
