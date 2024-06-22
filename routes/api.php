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

//Route::post('auth/register',[AuthController::class,'register']);
//Route::post('auth/login',[AuthController::class,'login']);
Route::match(['get','post'],'auth/register',[AuthController::class,'register'])->name('register');
Route::match(['get','post'],'auth/login',[AuthController::class,'login'])->name('login');
Route::get('home', [AuthController::class, 'home'])->name('home');
Route::group([
    'middleware' => 'auth',
    'prefix' => 'auth'
], function ($router) {
    Route::match(['get','post'],'logout', [AuthController::class, 'logout'])->name('logout');
  //  Route::post('refresh', [AuthController::class, 'refresh']);
  Route::match(['get','post'],'me',[AuthController::class,'me'])->name('profile');
});
Route::group([
    'middleware' => ['guest','web'],
    'prefix' => 'auth'
], function ($router) {
    Route::match(['get','post'],'register',[AuthController::class,'register'])->name('register');
    Route::match(['get','post'],'login',[AuthController::class,'login'])->name('login');
});
