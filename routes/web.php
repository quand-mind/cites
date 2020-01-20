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

Route::get('/', function () {
    return view('welcome');
});

// Frontend routes for "proyecto"
Route::group(['prefix' => 'proyecto'], function () {
    Route::get('/{any}', function () {
        return view('welcome');
    });
});
// Frontend routes for "Transgenico"
Route::get('/transgenico', function () {
    return view('welcome');
})->name('trangenico');

// Frontend routes for "¿Quienes somos?"
Route::group(['prefix' => 'somos'], function () {
    Route::get('/{any}', function () {
        return view('welcome');
    });
});

// Frontend routes for "FAQs"
Route::get('/preguntas-frecuentes-encuestas', function () {
    return view('welcome');
})->name('preguntas-frecuentes-encuestas');

// Frontend routes for "Protocolo de Cartagena"
Route::get('/protocolo', function () {
    return view('welcome');
})->name('protocolo');

// Frontend routes for "Protocolo de Cartagena"
Route::group(['prefix' => 'protocolo'], function () {
    Route::get('/{any}', function () {
        return view('welcome');
    });
});

// Frontend routes for "Proyectos asociados"
Route::group(['prefix' => 'asociados'], function () {
    Route::get('/{any}', function () {
        return view('welcome');
    });
});

// Frontend routes for "Laboratorio Nacional OVM"
Route::get('/laboratorio-nacional-ovm', function () {
    return view('welcome');
})->name('laboratorio-nacional-ovm');

// Frontend routes for "Recursos"
Route::group(['prefix' => 'recursos'], function () {
    Route::get('/{any}', function () {
        return view('welcome');
    });
});

// Frontend routes for "Transgénico"
Route::get('/transgenico', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'panel.auth'])->group(function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', 'DashboardController@index');

        // Users Routes
        Route::get('/users', 'UserController@index')->name('users');
        Route::post('/users/create', 'UserController@store');
        Route::post('/users/edit/{id}', 'UserController@update');
        Route::post('/users/changeActiveState/{id}', 'UserController@changeActiveState');
        Route::delete('/users/{id}', 'UserController@destroy');

        // Post Routes
        Route::get('/posts', 'PostController@index')->name('posts');
        Route::get('/posts/create', 'PostController@create');
        Route::post('/posts/create', 'PostController@store');
        Route::get('/posts/edit/{id}', 'PostController@edit');
        Route::post('/posts/edit/{id}', 'PostController@update');
        Route::post('/posts/changeActiveState/{id}', 'PostController@changeActiveState');
        Route::delete('/posts/{id}', 'PostController@destroy');

        // Image Routes
        Route::post('/images/post/content', 'ImageController@savePostContentImage');
        Route::post('/images/post/content/delete', 'ImageController@deletePostContentImage');
        Route::post('/images/post/main', 'ImageController@savePostMainImage');
        Route::post('/images/post/main/update/{id}', 'ImageController@updatePostMainImage');

        // Question Routes
        Route::get('/questions', 'QuestionController@index');
        Route::get('/question', 'QuestionController@create'); // Test form in the admin panel
        Route::post('/question/changeStatus/{id}', 'QuestionController@changeStatus');

        // Surveys Routes
        Route::get('/surveys', 'SurveyController@index');
        Route::post('/survey', 'SurveyController@store');
        Route::post('/survey/update/{id}', 'SurveyController@update');
    });
});

// Question client routes
Route::get('/questions', 'QuestionController@getFAQs');
Route::post('/question', 'QuestionController@store');
Route::post('/question/update/{id}', 'QuestionController@update');

// Migration routes
Route::get('/migrate/seed', 'MigrationsController@seed');
