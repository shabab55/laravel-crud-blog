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

Route::get('/', function () {
    return view('first_page');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/insert-post','PostController@store');

Route::get('/all-post','PostController@AllPost')->name('all.posts');
Route::get('/delete-post/{id}','PostController@Delete');
Route::get('/edit-post/{id}','PostController@Edit');
Route::post('/update-post/{id}','PostController@Update');
Route::get('/password-change','HomeController@PasswordChange')->name('password.change');
Route::post('/update-pass','HomeController@UpdatePass');

//news route
Route::get('/news-add','PostController@News')->name('news.add');
Route::post('/insert-news','PostController@InsertNews');
Route::get('/all-news','PostController@AllNews')->name('all.news');

Route::get('/delete-news/{id}','PostController@DeleteNews');

Route::get('/single_news/{id}','NewsController@SingleNewsView');
