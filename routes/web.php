<?php

use App\Http\Controllers\SetPasswordController;

use App\Http\Controllers\ApiController;

use App\Http\Controllers\AuthController;
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
    // return view('welcome');

// })->name('transgenico');

// // Frontend routes for "¿Quienes somos?"
// Route::group(['prefix' => 'somos'], function () {
//     Route::get('/{any}', 'MenuController@renderFrontPage');
// });

// Frontend routes for "FAQs"

use Illuminate\Support\Facades\Artisan;

Route::get('/secret/resetPassword', [AuthController::class, 'viewRestoreOfficialPassword']);
Route::post('/test/sendEmailResetPassword', [AuthController::class, 'sendEmailOfficialResetPassword']);
Route::get('/secret/restorePassword/{token}', [AuthController::class, 'restoreOfficialPassword'])->name('restorePassword');
Route::post('/secret/saveNewPassword', [AuthController::class, 'resetPasswordOfficial']);


Route::get('/preguntas-frecuentes', 'PageController@faqsView')->name('preguntas-frecuentes');
Route::group(['prefix' => 'como-participar'], function () {
    Route::get('/encuestas', 'PageController@encuestasView')->name('encuestas');
    Route::get('/encuestas/{id}', 'PageController@showSurvey');
    Route::get('/{slug}', 'PageController@newQuestionView')->name('pregunta-adicional');
});

Route::get('/legislacion', 'PageController@laws');
Route::get('/glosario', 'PageController@glosaryView');

Route::group(['prefix' => 'recursos'], function () {
    Route::get('/glosario', 'PageController@glosaryView');
    Route::get('/acronimos', 'PageController@acronimosView');
});

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

// // Frontend routes for "Laboratorio Nacional OGM"
// Route::get('/laboratorio-nacional-OGM', function () {
//     return view('welcome');
// })->name('laboratorio-nacional-OGM');

// // Frontend routes for "Recursos"
// Route::group(['prefix' => 'recursos'], function () {
//     Route::get('/{any}', 'MenuController@renderFrontPage');
// });

// // Frontend routes for "Transgénico"
// Route::get('/transgenico', function () {
//     return view('welcome'); 
// });

// Route::get('/register', ['AuthController@index']);
Auth::routes();


Route::get('/register', [AuthController::class, 'index'])->name('register');
// Route::get('/login', 'Auth\PermissionsLoginController@showLoginForm')->name('login');
Route::get('/loginClient', 'Auth\PermissionsLoginController@showLoginForm')->name('loginClient');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/reset', 'Auth\ResetPasswordController@sendClientResetEmail')->name('emailToReset');
Route::get('/recoveryPassword', 'Auth\ResetPasswordController@recoveryClientPassword')->name('recoveryPassword');
Route::post('/password/reset', 'Auth\ResetPasswordController@resetClientPassword')->name('resetPassword');

Route::get('permitInfo/{id}', 'PermissionController@showPermitInfo')->name('showPermitInfo');
Route::get('createFolder/', 'PermissionController@createFolder');
Route::post('createFolder/', 'PermissionController@createFolder');

Route::middleware('auth:api')->get('/home', 'HomeController@index')->name('home');

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
        Route::post('/pages/toggleIsOnMenu/{id}', 'PageController@toggleIsOnMenu');
        Route::post('/pages/changeActiveState/{id}', 'PageController@changeActiveState');
        Route::get('/pages/setAsMainPage/{id}', 'PageController@setAsMainPage');
        Route::delete('/pages/{id}', 'PageController@destroy');

        // Image Routes
        Route::post('/images/post/content', 'ImageController@savePostContentImage');
        Route::post('/images/post/content/delete', 'ImageController@deletePostContentImage');
        Route::post('/images/post/main', 'ImageController@savePostMainImage');
        Route::post('/images/post/main/update/{id}', 'ImageController@updatePostMainImage');
        Route::post('/images/page/content', 'ImageController@savePageContentImage');
        Route::post('/images/page/content/delete', 'ImageController@deletePageContentImage');

        // Multimedia Routes
        Route::get('/media', 'MediaController@index');
        Route::post('/media', 'MediaController@store');
        Route::delete('/media/{id}', 'MediaController@destroy');

        // Question Routes
        Route::get('/questions', 'QuestionController@index');
        Route::get('/question', 'QuestionController@create'); // Test form in the admin panel
        Route::post('/question/changeStatus/{id}', 'QuestionController@changeStatus');

        Route::delete('/questions/{id}', 'QuestionController@destroy');

        // Surveys Routes
        Route::get('/surveys', 'SurveyController@index');
        Route::post('/survey', 'SurveyController@store');
        Route::post('/surveys/edit/{id}', 'SurveyController@update');
        Route::delete('/surveys/{id}', 'SurveyController@destroy');

        // Glosary Routes
        Route::get('/glosary', 'GlosaryController@index');
        Route::post('/glosary', 'GlosaryController@store');
        Route::post('/glosary/edit/{id}', 'GlosaryController@update');
        Route::delete('/glosary/{id}', 'GlosaryController@destroy');

        // Acronimos Routes
        Route::get('/acronimos', 'AcronimoController@index');
        Route::post('/acronimos', 'AcronimoController@store');
        Route::post('/acronimos/edit/{id}', 'AcronimoController@update');
        Route::delete('/acronimos/{id}', 'AcronimoController@destroy');

        // Laws Routes
        Route::get('/laws', 'LegalFileController@index');
        Route::post('/laws/create', 'LegalFileController@store');
        Route::post('/laws/edit/{id}', 'LegalFileController@update');
        Route::delete('/laws/{id}', 'LegalFileController@destroy');

        // Header Routes
        Route::get('/header-manager', 'HeaderImageController@index');
        Route::post('/header-manager', 'HeaderImageController@store');
        Route::delete('/header-manager/{id}', 'HeaderImageController@destroy');

        // Aside Routes
        Route::get('/aside-manager', 'AsideImageController@index');
        Route::post('/aside-manager', 'AsideImageController@store');
        Route::post('/aside-manager/updateAll', 'AsideImageController@updateAll');
        Route::post('/aside-manager/update/{id}', 'AsideImageController@updateOne');
        Route::delete('/aside-manager/{id}', 'AsideImageController@destroy');

        // Social Links
        Route::get('/social-links', 'LinkController@index');
        Route::get('/social-links/list', 'LinkController@getLinks');
        Route::post('/social-links/create', 'LinkController@store');
        Route::get('/social-links/toggleIsVisible/{id}', 'LinkController@toggleIsVisible');
        Route::delete('/social-links/{id}', 'LinkController@destroy');

        // Permissions Routes
        Route::get('/permissions', 'PermissionController@getList');

        Route::get('/permissions/table', 'PermissionController@showPermitsTableView');

        Route::get('/permissions/check/{id}', 'PermissionController@showChecklist');

        Route::get('/permissions/requerimentsView', 'RequerimentController@index');
        Route::get('/permissions/permitsView', 'PermissionController@showPermitsView');

        Route::get('/permissions/getDepartaments', 'DepartamentController@index');
        Route::get('/permissions/getRequeriments', 'RequerimentController@getRequeriments');
        
        Route::post('/permissions/addPermit', 'IntoPermitDbController@addPermitType');
        Route::post('/permissions/editPermit/{id}', 'IntoPermitDbController@editPermitType');
        Route::post('/permissions/deletePermit/{id}', 'IntoPermitDbController@deletePermitType');
        
        Route::post('/permissions/addRequeriment', 'RequerimentController@addRequeriment');
        Route::post('/permissions/editRequeriment/{id}', 'RequerimentController@editRequeriment');
        Route::post('/permissions/deleteRequeriment/{id}', 'RequerimentController@deleteRequeriment');

        Route::post('/permissions/uploadSpecieFile', 'PermissionController@storeSpecieFile');
        Route::post('/permissions/uploadFile', 'PermissionController@storeFile');

        Route::post('/permissions/check/{id}', 'PermissionController@checkPermit');
        Route::post('/permissions/checkSpecies/{id}', 'PermissionController@checkSpecies');
        
        Route::post('/permissions/validPermit/{id}', 'PermissionController@validPermit');
        Route::post('/permissions/sendErrors/{id}', 'PermissionController@sendErrors');
        Route::get('/permissions/viewPermit/{id}', 'PermissionController@showAprovedPermit');
        
        Route::get('/permissions/graphics', 'StatisticsController@index');
        Route::get('/permissions/graphics/permitTypeStatistics', 'StatisticsController@showPermitTypeStatistics');
        Route::get('/permissions/graphics/speciesStatistics', 'StatisticsController@showSpeciesStatistics');

        Route::post('/permissions/graphics/selectSpecies', 'StatisticsController@selectSpecies');

        Route::get('/permissions/graphics/permitsDateStatistics', 'StatisticsController@showPermitForDateStatistics');
        
        Route::get('/permissions/annual-report', 'StatisticsController@showAnnualReport');

        Route::post('/permissions/graphics/selectDate', 'StatisticsController@selectDate');
        Route::post('/permissions/graphics/exportSpeciesData', 'StatisticsController@exportSpeciesData');
        Route::get('/permissions/graphics/exportSpeciesData', 'StatisticsController@exportSpeciesData');
        Route::get('/permissions/graphics/exportPermitsData', 'StatisticsController@exportPermitsData');
        
        Route::get('/permissions/annual-report/export', 'StatisticsController@exportAnnualReport');

        Route::post('/searchSpecie', 'ApiController@api_cites_filter');

        Route::get('/species/speciesDetails', 'SpecieController@showSpeciesDetails');
        Route::post('/species/registerSpecie', 'SpecieController@registerSpecie');
        Route::post('/species/editSpecie', 'SpecieController@editSpecie');
        Route::post('/species/searchSpecieData', 'SpecieController@api_cites');
    });
});
Route::get('/dataQr/{id}', 'PermissionController@getDataQr');

// Question client routes
Route::get('/questions', 'QuestionController@getFAQs');
Route::post('/question', 'QuestionController@store');
Route::post('/question/update/{id}', 'QuestionController@update');

// Survey client routes
Route::get('/surveys-list', 'SurveyController@getSurveysList');

// Migration routes
Route::get('/migrate', 'MigrationsController@migrate');
Route::get('/migrate/seed', 'MigrationsController@seed');

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
// Render files
Route::get('/files/requeriments/{user}/{formalitie}/{permit}/{file_url}', 'PermissionController@showFile');
Route::get('/files/requeriments/{user}/personals/{file_url}', 'PermissionController@showFilePersonal');
Route::get('/files/requeriments/{user}/{file_url}', 'LegalFileController@show');

Route::get('/forums', ['uses' => '\DevDojo\Chatter\Controllers\ChatterController@index'])->name('chatter.home');         
Route::get('/forums.atom', ['uses' => '\DevDojo\Chatter\Controllers\ChatterAtomController@index'])->name('chatter.atom');
Route::get('/forums/category/{slug}', ['uses' => '\DevDojo\Chatter\Controllers\ChatterController@index'])->name('chatter.category.show');
Route::get('/forums/discussion', ['uses' => '\DevDojo\Chatter\Controllers\ChatterDiscussionController@index'])->name('chatter.discussion.index');
Route::post('/forums/discussion', ['uses' => '\DevDojo\Chatter\Controllers\ChatterDiscussionController@store'])->name('chatter.discussion.store');
Route::get('/forums/discussion/create', ['uses' => '\DevDojo\Chatter\Controllers\ChatterDiscussionController@create'])->name('chatter.discussion.create');
Route::get('/forums/discussion/{category}/{slug}', ['uses' => '\DevDojo\Chatter\Controllers\ChatterDiscussionController@show'])->name('chatter.discussion.showInCategory');
Route::post('/forums/discussion/{category}/{slug}/email', ['uses' => '\DevDojo\Chatter\Controllers\ChatterDiscussionController@toggleE'])->name('chatter.discussion.email');
Route::get('/forums/discussion/{discussion}', ['uses' => '\DevDojo\Chatter\Controllers\ChatterDiscussionController@show'])->name('chatter.discussion.show');
Route::put('/forums/discussion/{discussion}', ['uses' => '\DevDojo\Chatter\Controllers\ChatterDiscussionController@update'])->name('chatter.discussion.update');
Route::delete('/forums/discussion/{discussion}', ['uses' => '\DevDojo\Chatter\Controllers\ChatterDiscussionController@destroy'])->name('chatter.discussion.destroy');

// Header
Route::get('/header-images', 'HeaderImageController@show');

// Aside
Route::get('/aside-images', 'AsideImageController@show');

Route::post('/sendEmail', [SetPasswordController::class, 'sendEmail']);
Route::get('/setPassword/{token}', [SetPasswordController::class, 'showSetPasswordForm'])->name('set.password.get');
Route::post('/setPasswordSubmit', [SetPasswordController::class, 'submitSetPasswordForm'])->name('set.password.submit');

Route::post('/save-file-nurseris', 'AuthorizationController@SaveFileZooHatcherie');
//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::post('/loginAdmin', 'AuthController@login_admin');

Route::get('/species_cite', 'ApiController@api_cites')->name('cite_species');

// Frontend pages controller
Route::get('/{slug?}', 'PageController@show');

// Frontend pages controller
Route::get('/{slug}/{subpage}', 'PageController@showSubPage');

//crud Permit and Requeriment



