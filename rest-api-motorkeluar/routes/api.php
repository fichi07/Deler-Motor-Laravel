<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\MotorkeluarController;
use App\Models\motorkeluar;
use App\Http\Controllers\API\MotorkeluarController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BaseController;


Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);

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
/*Route::middleware('auth:sanctum')->group( function() {
    Route::resource('motorkeluar', MotorkeluarController::class);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::get('motorkeluar',[MotorkeluarController::class,'index']);
Route::post('motorkeluar',[MotorkeluarController::class,'create']);
Route::put('/motorkeluar/{id}',[MotorkeluarController::class,'update']);
Route::delete('motorkeluar/{id}',[MotorkeluarController::class,'destroy']);
Route::get('motorkeluar/{id}', [MotorkeluarController::class, 'show']);