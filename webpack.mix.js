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

mix.styles([ // указываем первым аргументом массив стилей которые нужно компилировать во втором аргументе
    'resources/front/css/bootstrap.css',
    'resources/front/css/main.css'
], 'public/css/styles.css');

mix.scripts([ // тут тоже самое что и выше только работаем с Vanilla JS
    'resources/front/js/jquery-3.5.1.slim.js',
    'resources/front/js/bootstrap.js'
], 'public/js/scripts.js');

mix.copyDirectory('resources/front/img', 'public/img'); // копируем папку с изображениями в папку которая указанна во втором аргументе

mix.browserSync('laravel.loc');
