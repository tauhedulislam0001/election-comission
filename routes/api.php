<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Agent\AgentRegisterController;
use App\Http\Controllers\Api\UpdatePassword\ApiUpdatePasswordController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// =================== Auth Controller ===================================

Route::group(['middleware' => 'api','prefix' => 'v1/auth'], function ($router) {
    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('checkToken', [AuthController::class,'checkToken']);
    Route::get('me', [AuthController::class,'me']);
    Route::post('Agent/register', [AgentRegisterController::class, 'store']);

});

Route::group(['prefix' => 'v1/'], function ($router) {

});

Route::group(['middleware' => 'jwt_verify','prefix' => 'v1'], function ($router) {

//=================== Api update Password Controller ===================

Route::post('/update-password', [ApiUpdatePasswordController::class, 'updatePassword'])->name('api.updatePassword');

});
