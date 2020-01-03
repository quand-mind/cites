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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'panel.auth'])->group(function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', 'DashboardController@index');

        // Users Controllers
        Route::get('/users', 'UserController@index')->name('users');
        Route::post('/users/create', 'UserController@store');
        Route::post('/users/edit/{id}', 'UserController@update');
        Route::post('/users/changeActiveState/{id}', 'UserController@changeActiveState');
        Route::delete('/users/{id}', 'UserController@destroy');

        // Post Controllers
        Route::get('/posts', 'PostController@index')->name('post');
        Route::get('/posts/edit/{id}', 'PostController@edit');
        Route::post('/posts/edit/{id}', 'PostController@update');
        Route::post('/posts/changeActiveState/{id}', 'PostController@changeActiveState');
    });
});
