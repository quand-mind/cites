<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 *  rutas para el login y logout de los clientes
 */
Route::post('/registerClient', [AuthController::class, 'storeClient']);
Route::post('/loginPermissions', [AuthController::class, 'login']);
Route::get('/users', [AuthController::class, 'user']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('jwt.verify');

Route::post('/tets', [AuthorizationController::class, 'createPermits'])->name('test');
Route::post('/saveFile', [AuthorizationController::class, 'Nurseries']);

Route::get('species', [ApiController::class, 'api_cites']);

Route::get('species_filter', [ApiController::class, 'api_cites_filter']);


/**
 *  login admin
*/
Route::post('/loginAdmin', [LoginController::class, 'login_admin']);


Route::middleware('auth:api')->group(function () {
    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/', 'PermissionController@index');
    
        // Authorizations Routes
        // Route::get('/authorizations', 'AuthorizationController@index');
    
        // Permissions Routes
        Route::get('/list', 'PermitTypeController@index');

        Route::post('/requestPermit/{id}', 'PermissionController@requestPermit');
        Route::get('/permit_form/{id}', 'PermissionController@getForm');
        Route::post('/list/createPermit', 'PermissionController@storePermit');

        Route::get('/uploadRequirements/{id}', 'PermissionController@showUploadRequeriments');

        Route::post('/uploadSpecieFile', 'PermissionController@storeSpecieFile');
        Route::post('/deleteSpecieFile/{id}', 'PermissionController@deleteSpecieFile');

        Route::post('/uploadFile', 'PermissionController@storeFile');
        Route::post('/deleteFile/{id}', 'PermissionController@deleteFile');
        
        Route::post('/addSpecie', 'PermissionController@addSpecie');
        Route::post('/deleteSpecie', 'PermissionController@deleteSpecie');

        Route::get('/viewPermit/{id}', 'PermissionController@showAprovedPermit');
        Route::post('/printPermit/{id}', 'PermissionController@printAprovedPermit');
    });
});

