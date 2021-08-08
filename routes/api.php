<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
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

Route::middleware('jwt.verify')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 *  rutas para el login y logout de los clientes
 */

Route::post('/loginPermissions', [AuthController::class, 'login']);
Route::get('/users', [AuthController::class, 'user']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('jwt.verify');

Route::post('/tets', [AuthorizationController::class, 'createPermits'])->name('test');
Route::post('/saveFile', [AuthorizationController::class, 'Nurseries']);

Route::get('species', [ApiController::class, 'api_cites']);