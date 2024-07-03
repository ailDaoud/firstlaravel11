<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\LangControllre;
use App\Http\Middleware\Localize;

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



Route::middleware(Localize::class)->group(function () {
    Route::get('auth/home/{lang}',[LangControllre::class,'setlang']);
    Route::get('auth/local/local/{lang}',[LangControllre::class,'back']);
  //  Route::get('auth/local/local/{lang}',[LangControllre::class,'back']);
  Route::get('auth/local/en',[LangControllre::class,'e'])->name('e');
  Route::get('auth/local/ar',[LangControllre::class,'a'])->name('a');

    Route::resource('users', UserController::class);
    Route::controller(UserController::class)->group(function () {
        Route::post('/user/update/{id}', 'update');
    });
    Route::controller(AdsController::class)->group(function () {
        Route::get('/ads/get', 'index')->name('getads');
        Route::delete('/ads/delete/{id}', 'destroy');
        Route::get('/ads/show/{id}', 'show');
        Route::post('/ads/store', 'store');
        Route::post('/ads/update/{id}', 'update');
    });


    Route::get('home', [AuthController::class, 'home'])->name('home');
    Route::group([
        'middleware' => 'auth',
        'prefix' => 'auth'
    ], function ($router) {
        Route::match(['get', 'post'], 'logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('home', [AuthController::class, 'home'])->name('home');
        Route::match(['get', 'post'], 'profile', [AuthController::class, 'profile'])->name('profile');
    });

});
Route::group([
    //   'middleware' => ['guest','web'],
    'prefix' => 'auth'
], function ($router) {
    Route::match(['get', 'post'], 'register', [AuthController::class, 'register'])->name('register');
    Route::match(['get', 'post'], 'login', [AuthController::class, 'login'])->name('login');
    Route::match(['get', 'post'], 'verify_otp', [AuthController::class, 'verify_otp'])->name('verify_otp');
  //  Route::get('local/{lang}',[LangControllre::class,'setlang']);
});

