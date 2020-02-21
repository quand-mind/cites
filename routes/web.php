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

// Route::get('/', 'MenuController@renderFrontPage');

// // Frontend routes for "proyecto"
// Route::group(['prefix' => 'proyecto'], function () {
//     Route::get('/{any}', 'MenuController@renderFrontPage');
// });
// // Frontend routes for "Transgenico"
// Route::get('/transgenico', function () {
<<<<<<< HEAD

    // return view('welcome');

=======
//     return view('welcome');
>>>>>>> 951638c0dee127320e517895056ced123809b00e
// })->name('transgenico');

// // Frontend routes for "¿Quienes somos?"
// Route::group(['prefix' => 'somos'], function () {
//     Route::get('/{any}', 'MenuController@renderFrontPage');
// });

// Frontend routes for "FAQs"

use Illuminate\Support\Facades\Artisan;

<<<<<<< HEAD

=======
>>>>>>> 951638c0dee127320e517895056ced123809b00e
Route::get('/preguntas-frecuentes', 'PageController@faqsView')->name('preguntas-frecuentes');
Route::get('/como-participar/encuesta', 'PageController@encuestasView')->name('encuestas');
Route::get('/como-participar/desea-hacer-una-pregunta-adicional', 'PageController@newQuestionView')->name('pregunta-adicional');

// // Frontend routes for "Encuestas"
// Route::get('/encuestas', function () {
//     return view('welcome');
// })->name('encuestas');

// // Frontend routes for "Protocolo de Cartagena"
// Route::get('/protocolo', function () {
//     return view('welcome');
// })->name('protocolo');

// // Frontend routes for "Protocolo de Cartagena"
// Route::group(['prefix' => 'protocolo'], function () {
//     Route::get('/{any}', 'MenuController@renderFrontPage');
// });

// // Frontend routes for "Proyectos asociados"
// Route::group(['prefix' => 'asociados'], function () {
//     Route::get('/{any}', 'MenuController@renderFrontPage');
// });

// // Frontend routes for "Laboratorio Nacional OVM"
// Route::get('/laboratorio-nacional-ovm', function () {
//     return view('welcome');
// })->name('laboratorio-nacional-ovm');

// // Frontend routes for "Recursos"
// Route::group(['prefix' => 'recursos'], function () {
//     Route::get('/{any}', 'MenuController@renderFrontPage');
// });

// // Frontend routes for "Transgénico"
// Route::get('/transgenico', function () {
//     return view('welcome');
// });

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

        // Menu Routes
        Route::get('/menu', 'MenuController@index')->name('menu');
        Route::post('/menu/changeMenuVisibility/{id}', 'MenuController@changeMenuVisibility');
        Route::post('/menu/updateOrder', 'MenuController@updateOrder');
        Route::delete('/menu/{id}', 'MenuController@destroy');


        // Post Routes
        Route::get('/posts', 'PostController@index')->name('posts');
        Route::get('/posts/create', 'PostController@create');
        Route::post('/posts/create', 'PostController@store');
        Route::get('/posts/edit/{id}', 'PostController@edit');
        Route::post('/posts/edit/{id}', 'PostController@update');
        Route::post('/posts/changeActiveState/{id}', 'PostController@changeActiveState');
        Route::delete('/posts/{id}', 'PostController@destroy');

        // Pages Routes
        Route::get('/pages', 'PageController@index')->name('pages');
        Route::get('/pages/create', 'PageController@create');
        Route::post('/pages/create', 'PageController@store');
        Route::get('/pages/edit/{id}', 'PageController@edit');
        Route::post('/pages/edit/{id}', 'PageController@update');
        Route::post('/pages/changeActiveState/{id}', 'PageController@changeActiveState');
        Route::delete('/pages/{id}', 'PageController@destroy');

        // Image Routes
        Route::post('/images/post/content', 'ImageController@savePostContentImage');
        Route::post('/images/post/content/delete', 'ImageController@deletePostContentImage');
        Route::post('/images/post/main', 'ImageController@savePostMainImage');
        Route::post('/images/post/main/update/{id}', 'ImageController@updatePostMainImage');
        Route::post('/images/page/content', 'ImageController@savePageContentImage');
        Route::post('/images/page/content/delete', 'ImageController@deletePageContentImage');

        // Question Routes
        Route::get('/questions', 'QuestionController@index');
        Route::get('/question', 'QuestionController@create'); // Test form in the admin panel
        Route::post('/question/changeStatus/{id}', 'QuestionController@changeStatus');
<<<<<<< HEAD

        Route::delete('/questions/{id}', 'QuestionController@destroy');

=======
        Route::delete('/questions/{id}', 'QuestionController@destroy');
>>>>>>> 951638c0dee127320e517895056ced123809b00e

        // Surveys Routes
        Route::get('/surveys', 'SurveyController@index');
        Route::post('/survey', 'SurveyController@store');
        Route::post('/surveys/edit/{id}', 'SurveyController@update');
        Route::delete('/surveys/{id}', 'SurveyController@destroy');
<<<<<<< HEAD

=======
>>>>>>> 951638c0dee127320e517895056ced123809b00e

        // Glosary Routes
        Route::get('/glosary', 'GlosaryController@index');

        // Acronimos Routes
        Route::get('/acronimos', 'acronimoController@index');

<<<<<<< HEAD


        // laws Routes
=======
        // Laws Routes
>>>>>>> 951638c0dee127320e517895056ced123809b00e
        Route::get('/laws', 'LegalFileController@index');
        Route::post('/laws/create', 'LegalFileController@store');
        Route::post('/laws/edit/{id}', 'LegalFileController@update');
        Route::delete('/laws/{id}', 'LegalFileController@destroy');
<<<<<<< HEAD

=======
>>>>>>> 951638c0dee127320e517895056ced123809b00e
    });
});

// Question client routes
Route::get('/questions', 'QuestionController@getFAQs');
Route::post('/question', 'QuestionController@store');
Route::post('/question/update/{id}', 'QuestionController@update');

// Survey client routes
Route::get('/surveys-list', 'SurveyController@getSurveysList');

// Migration routes
Route::get('/migrate', 'MigrationsController@migrate');
Route::get('/migrate/seed', 'MigrationsController@seed');

<<<<<<< HEAD

=======
>>>>>>> 951638c0dee127320e517895056ced123809b00e
// Link storage
Route::get('/link/storage', function () {
    Artisan::call('storage:link', []);
    return "Linked storage completed";
});

// Clear app
Route::get('/clear-app', function () {
    Artisan::call('cache:clear', []);
    Artisan::call('route:clear', []);
    Artisan::call('config:clear', []);
    Artisan::call('view:clear', []);
    return "Clear the app deployment completed";
});

<<<<<<< HEAD
=======
// Render files
Route::get('/files/{name}', 'LegalFileController@show');

>>>>>>> 951638c0dee127320e517895056ced123809b00e
// Frontend pages controller
Route::get('/{slug?}', 'PageController@show');

// Frontend pages controller
Route::get('/{slug}/{subpage}', 'PageController@showSubPage');