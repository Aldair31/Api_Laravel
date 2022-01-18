<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;

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

Route::get('list/{id?}',[DeviceController::class,'list']);
Route::post('add',[DeviceController::class,'add']);
Route::put('edit/{id?}',[DeviceController::class,'edit']);
Route::delete('delete/{id?}', [DeviceController::class,'delete']);
Route::get('search/{id?}',[DeviceController::class,'search']);
Route::post('login',[UserController::class,'login']);
Route::post('register',[UserController::class,'register']);
Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::apiResource('member',MemberController::class);
    Route::get('list/{id?}',[DeviceController::class,'list']);
});
