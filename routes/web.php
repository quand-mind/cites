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

// Frontend routes
// Manda a todas esas urls a renderizar la vista "welcome"
Route::get('/', function () {
    return view('welcome');
});
Route::get('/somos/grupos', function () {
    return view('welcome');
})->name('somos-grupos');
Route::get('/faqs-encuestas', function () {
    return view('welcome');
})->name('faqs-encuestas');

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
        Route::get('/posts', 'PostController@index')->name('posts');
        Route::get('/posts/create', 'PostController@create');
        Route::post('/posts/create', 'PostController@store');
        Route::get('/posts/edit/{id}', 'PostController@edit');
        Route::post('/posts/edit/{id}', 'PostController@update');
        Route::post('/posts/changeActiveState/{id}', 'PostController@changeActiveState');
        Route::delete('/posts/{id}', 'PostController@destroy');

        // Image Controllers
        Route::post('/images/post/content', 'ImageController@savePostContentImage');
        Route::post('/images/post/content/delete', 'ImageController@deletePostContentImage');
        Route::post('/images/post/main', 'ImageController@savePostMainImage');
        Route::post('/images/post/main/update/{id}', 'ImageController@updatePostMainImage');

        // Question Controllers
        Route::get('/questions', 'QuestionController@index');
        Route::get('/question', 'QuestionController@create'); // Test form in the admin panel
        Route::post('/question/changeStatus/{id}', 'QuestionController@changeStatus');
    });
});

// Question client routes
Route::get('/questions', 'QuestionController@getFAQs');
Route::post('/question', 'QuestionController@store');
Route::post('/question/update/{id}', 'QuestionController@update');
