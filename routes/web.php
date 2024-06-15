<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdsController;
use App\Http\Middleware\Localize;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(Localize::class)->group(function(){
    Route::resource('users',UserController::class);
});

Route::controller(UserController::class)->group(function () {
    Route::post('/user/update/{id}', 'update');
});
Route::controller(AdsController::class)->group(function () {
    Route::get('/ads/get', 'index');
    Route::delete('/ads/delete/{id}', 'destroy');
    Route::get('/ads/show/{id}', 'show');
    Route::post('/ads/store', 'store');
    Route::post('/ads/update/{id}', 'update');
});
Route::controller(UserController::class)->group(function () {
    Route::get('/usere', 'index');
});
