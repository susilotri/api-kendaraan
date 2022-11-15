<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\KendaraanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'Api'], function(){
    Route::post('login', [ApiController::class, 'authenticate']);
    Route::post('register', [ApiController::class, 'register']);
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::get('logout', [ApiController::class, 'logout']);
        Route::get('get_user', [ApiController::class, 'get_user']);


        Route::get('kendaraan', [KendaraanController::class, 'index']);
        Route::post('kendaraan/store', [KendaraanController::class, 'store']);
        Route::get('kendaraan/find', [KendaraanController::class, 'find']);
        Route::get('kendaraan/selling', [KendaraanController::class, 'sell']);
        Route::get('kendaraan/reporting', [KendaraanController::class, 'report']);
    });

});
