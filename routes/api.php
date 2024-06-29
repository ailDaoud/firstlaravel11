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


Route::get('home', [AuthController::class, 'home'])->name('home');
Route::group([
    'middleware' => 'auth',
    'prefix' => 'auth'
], function ($router) {
    Route::match(['get','post'],'logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('home', [AuthController::class, 'home'])->name('home');
  Route::match(['get','post'],'profile',[AuthController::class,'profile'])->name('profile');
  Route::match(['get','post'],'verify_otp',[AuthController::class,'verify_otp'])->name('verify_otp');
});
Route::group([
 //   'middleware' => ['guest','web'],
    'prefix' => 'auth'
], function ($router) {
    Route::match(['get','post'],'register',[AuthController::class,'register'])->name('register');
    Route::match(['get','post'],'login',[AuthController::class,'login'])->name('login');
});
