<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\MotorController;
use App\Models\motor;
use App\Http\Controllers\API\MotorController;
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
/*8Route::middleware('auth:sanctum')->group( function() {
    Route::resource('motor', MotorController::class);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::get('motor',[MotorController::class,'index']);
Route::post('motor',[MotorController::class,'create']);
Route::put('/motor/{id}',[MotorController::class,'update']);
Route::delete('motor/{id}',[MotorController::class,'destroy']);
Route::get('motor/{id}', [MotorController::class, 'show']);
