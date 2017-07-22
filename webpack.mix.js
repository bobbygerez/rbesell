const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
.sass('resources/assets/sass/app.scss', 'public/css'); 

mix.js('resources/assets/js/dashboard.js', 'public/template3/dashboard/assets/js/');

mix.styles([
	'public/template3/assets/css/bootstrap.min.css',
    'public/template3/assets/css/owl.carousel.min.css',
    'public/template3/assets/css/animated.css',
    'public/template3/assets/css/font-awesome.css',
    'public/template3/assets/css/ui.css',
    'public/template3/assets/css/jquery.mmenu.all.css',
    'public/template3/assets/css/flaticon.css',
    'public/template3/assets/css/style.css',
    'public/css/app.css'
], 'public/template3/assets/css/template3.css');




mix.scripts([
    'public/template3/assets/js/jquery.min.js',
    'public/template3/assets/js/bootstrap.min.js',
    'public/template3/assets/js/wow.min.js',
    'public/template3/assets/js/owl.carousel.min.js',
    'public/template3/assets/js/jquery.appear.min.js',
    'public/template3/assets/js/jquery.countTo.js',
    'public/template3/assets/js/ui.js',
    'public/template3/assets/js/jquery.bxslider.min.js',
    'public/template3/assets/js/jquery.mmenu.all.min.js',
    'public/template3/assets/js/chosen.jquery.min.js',
    'public/template3/assets/js/jquery.countdown.js',
    'public/template3/assets/js/frontend.js',
    'public/js/app.js'
], 'public/template3/assets/js/template3.js');


mix.styles([
    'public/template3/dashboard/assets/css/bootstrap.min.css',
    'public/template3/dashboard/assets/css/animate.min.css',
    'public/template3/dashboard/assets/css/paper-dashboard.css',
    'public/template3/dashboard/assets/css/demo.css',
    'public/template3/dashboard/assets/css/themify-icons.css',
], 'public/template3/dashboard/assets/css/dashboard.css');






