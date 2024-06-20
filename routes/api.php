<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::controller(UserController::class)->group(function () {
    Route::get('/showusers', 'index');
    Route::post('/store_user', 'store');
    Route::get('/user/show/{id}', 'show');
    Route::post('/user/update/{id}', 'update');
    Route::delete('/user/delete/{id}', 'destroy');
});

Route::post('auth/register',[AuthController::class,'register']);
Route::post('auth/login',[AuthController::class,'login']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('logout', [AuthController::class, 'logout']);
  //  Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});
