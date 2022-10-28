<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\PermissionController;

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
// Route::get('/registerClient', [AuthController::class, 'index']);
Route::post('/registerClient', [AuthController::class, 'storeClient']);
Route::post('/registerInstitution', [InstitutionController::class, 'storeInstitution']);
Route::post('/loginClient', [AuthController::class, 'login']);
Route::get('/users', [AuthController::class, 'user']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('jwt.verify');
 
Route::post('/tets', [AuthorizationController::class, 'createPermits'])->name('test');
Route::post('/saveFile', [AuthorizationController::class, 'Nurseries']);

/**
 * reset password 
 */

Route::get('/resetPassword', [AuthController::class, 'viewRestortPassword']);
Route::post('/sendEmailResetPassword', [AuthController::class, 'sendEmailClientResetPassword']);
Route::get('/RestortPassword/{token}', [AuthController::class, 'RestortPassword'])->name('RestortPassword')->middleware('auth:api');
Route::post('/saveNewPassword', [AuthController::class, 'resetPasswordClient']);


Route::get('species', [ApiController::class, 'api_cites']);
Route::get('countries', [ApiController::class, 'json_country']);
Route::get('species_filter', [ApiController::class, 'api_cites_filter']);

Route::get('/dayMoreTen', 'PermissionController@dayMoreTen');
Route::get('/testTask', 'IntoPermitDbController@readFileXlsx');
Route::get('/getPermitType', 'IntoPermitDbController@showPermitTypes');
Route::post('/editPermitType/{id}', 'IntoPermitDbController@editPermitType');
Route::post('/addRequerimentToPermitType/{id}', 'IntoPermitDbController@addRequerimentToPermitType');
Route::get('/DataCodeQr/{$id}', 'PermissionController@showPermitInfo');
// Route::get('/generateQr/{id}', 'PermissionController@getDataQr');

//route requeriment

Route::get('/getRequeriment', 'IntoRequerimentDbController@getRequeriment');
Route::post('/editRequerimen/{id}', 'IntoRequerimentDbController@editRequerimen');

/**
 *  login admin
*/
Route::post('/loginAdmin', [LoginController::class, 'login_admin']);


Route::middleware('auth:api')->group(function () {
    Route::get('/editUser', 'ClientController@index');
    Route::post('/editUser', 'ClientController@editClient');

    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/', 'PermissionController@index');
        
    
        // Authorizations Routes
        // Route::get('/authorizations', 'AuthorizationController@index');  
    
        // Permissions Routes
        Route::get('/list', 'PermitTypeController@index');

        Route::post('/requestPermit/{id}', 'PermissionController@requestPermit');
        Route::get('/permit_form/{id}', 'PermissionController@getForm');
        Route::post('/list/createPermit', 'PermissionController@storePermit');
        Route::post('/searchSpecie', 'ApiController@api_cites_filter');

        Route::get('/uploadRequirements/{id}', 'PermissionController@showUploadRequeriments');

        Route::post('/uploadSpecieFile', 'PermissionController@storeSpecieFile');
        Route::post('/deleteSpecieFile/{id}', 'PermissionController@deleteSpecieFile');

        Route::post('/uploadFile', 'PermissionController@storeFile');
        Route::post('/uploadPersonalFile', 'PermissionController@savePersonalFile');
        Route::post('/deleteFile/{id}', 'PermissionController@deleteFile');

        Route::get('/viewPermit/{id}', 'PermissionController@showAprovedPermit');
        Route::post('/printPermit/{id}', 'PermissionController@printAprovedPermit');
    });
});

/*
* rutas para filtrar los permisos
*/
Route::get('filterApplicant', [PermissionController::class, 'filterApplicant']);
Route::get('filterOfficial', [PermissionController::class, 'filterOfficial']);
Route::get('filterCountry', [PermissionController::class, 'filterCountry']);
Route::get('filterDate', [PermissionController::class, 'filterDate']);


Route::get('/chartForcountry', 'StatisticsController@chartForcountry');
Route::get('/chartForpermitType', 'StatisticsController@chartForpermitType');

//Export to CVS

Route::get('/PermitTypeStatisticsExport', 'StatisticsController@PermitTypeStatisticsExport');
Route::get('/SpeciesStatisticsExport', 'StatisticsController@SpeciesStatisticsExport');
Route::get('/PlantaeStatisticsExport', 'StatisticsController@PlantaeStatisticsExport');
Route::get('/AnimaliaStatisticsExport', 'StatisticsController@AnimaliaStatisticsExport');

Route::get("/testtoken", [ApiController::class, 'sendTokenApiExternal'] );
