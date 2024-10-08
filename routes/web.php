<?php

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

//Authendication
Route::get('/', 'AuthController@index')->name('login');
Route::post('/', 'AuthController@loginCheck')->name('login.check');
Route::get('/register', 'AuthController@registerIndex');
Route::post('/register', 'AuthController@registerStore')->name('register.store');

//Home
Route::get('/home', 'HomeController@index')->name('home');

//Post
Route::get('post/create', 'PostController@create')->name('post.create');
Route::post('post', 'PostController@store')->name('post.store');

Route::get('/posts', 'PostController@index');

