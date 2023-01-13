<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// сначала указываем контроллер который нужно выполнить и после @ указываем action данного контроллера

Route::get('/', 'HomeController@index')->name('home');
Route::get('/create', 'HomeController@create')->name('posts.create');
Route::post('/', 'HomeController@store')->name('posts.store');

Route::get('/page/about', 'PageController@show')->name('page.about');

//Route::get('/send', 'ContactController@send');

Route::match(['get', 'post'], '/send', 'ContactController@send');

Route::group(['middleware' => 'guest'], function () { // все эти маршруты мы обрабатываем посредником guest из Kernel, тоесть мы получаем доступ к данным маршрутам только если мы не авторизованы.
    Route::get('/register', 'UserController@create')->name('register.create');
    Route::post('/register', 'UserController@store')->name('register.store');
    Route::get('/login', 'UserController@loginForm')->name('login.create');
    Route::post('/login', 'UserController@login')->name('login');
});

Route::get('/logout', 'UserController@logout')->name('logout')->middleware('auth');

Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'MainController@index');
}); // данный маршрут будет обрабатываться посредником admin который мы указали в папке Kernel; тут подразумевается что адрес будет /admin из-за prefix; namespace нужен для того чтобы мы не указывали путь к папке в action из-того что MainController находится в папке Admin




//Route::get('/page/{slug}', 'PageController@show'); // тут slug мы будем передавать как аргумент в функцию show и сможем в контроллере к нему обращаться

//Route::resource('/admin/posts', 'PostController', ['parameters' => [
//    'posts' => 'slug', // тут мы говорим что posts будет обрабатываться по правилам slug из RouteServiceProvider
//]]); // при обращении к /admin/posts будет срабатывать PostController

//Route::fallback(function () {
////    return redirect()->route('home');
//    abort(404, 'Oops! Page not found...');
//});

//Route::prefix('admin')->name('admin.')->group(function () { // Перед каждым адресом указанным ниже будет добавляться префикс 'admin'
//    Route::get('/posts', function () { // http://laravel.loc/admin/posts
//        return 'Posts List';
//    });
//
//    Route::get('/post/create', function () { // http://laravel.loc/admin/post/create
//        return 'Post Create';
//    });
//
//    Route::get('/post/{id}/edit', function ($id) { // http://laravel.loc/admin/post/1/edit
//        return "Edit Post $id";
//    })->name('post');
//});


