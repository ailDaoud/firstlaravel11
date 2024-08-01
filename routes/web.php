<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\LangControllre;
use App\Http\Controllers\RoleController;
use App\Http\Middleware\Localize;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Contracts\Permission;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
Route::get('/', function () {
    return View('welcome');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/showusers', 'index');
    Route::post('/store_user', 'store');
    Route::get('/user/show/{id}', 'show');
    Route::post('/user/update/{id}', 'update');
    Route::delete('/user/delete/{id}', 'destroy');
});



Route::middleware(Localize::class)->group(function () {


    ////
    Route::get('auth/local/en', [LangControllre::class, 'e'])->name('e');
    Route::get('auth/local/ar', [LangControllre::class, 'a'])->name('a');
    ////



    //////////////
    Route::resource('users', UserController::class);
    Route::controller(UserController::class)->group(function () {
        Route::post('/user/update/{id}', 'update');
    });
    Route::get('users/{uId}/delete', [UserController::class, 'destroy2']);
    Route::get('users/{uId}/modify', [UserController::class, 'modify']);
    Route::put('users/{uId}/modify_roles', [UserController::class, 'modify_roles']);


    //*////////////////
    Route::controller(AdsController::class)->group(function () {
        Route::get('/ads/get', 'index')->name('getads');
        Route::delete('/ads/delete/{id}', 'destroy');
        Route::get('/ads/show/{id}', 'show');
        //   Route::post('/ads/store', 'store');
        Route::post('/ads/update/{id}', 'update');
    });
    //////////////

    Route::resource('permission', PermissionController::class);
    Route::get('permission/{pId}/delete', [PermissionController::class, 'destroy']);
    Route::get('permission/{pId}/edit', [PermissionController::class, 'edit']);
    Route::put('permission/{pId}/a', [PermissionController::class, 'update']);

    Route::resource('role', RoleController::class);
    Route::get('role/{rId}/delete', [RoleController::class, 'destroy']);
    Route::get('role/{rId}/edit', [RoleController::class, 'edit'])->middleware('auth');
    Route::put('role/{rId}/a', [RoleController::class, 'update']);
    Route::get('role/{rId}/give-p', [RoleController::class, 'givep'])->middleware('auth');
    Route::put('role/{rId}/give-p', [RoleController::class, 'updatep'])->middleware('auth');

    ///login
    Route::match(['get', 'post'], 'register', [AuthController::class, 'register'])->name('register');
    Route::match(['get', 'post'], 'login', [AuthController::class, 'login'])->name('login');
    Route::match(['get', 'post'], 'verify_otp', [AuthController::class, 'verify_otp'])->name('verify_otp');


    ///////////////
    Route::group([
        'middleware' => 'auth',
        'prefix' => 'auth'
    ], function ($router) {
        Route::match(['get', 'post'], 'addpost', [AdsController::class, 'store'])->name('addpost');
        Route::match(['get', 'post'], 'logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('home', [AuthController::class, 'home'])->name('home');
        Route::match(['get', 'post'], 'profile', [AuthController::class, 'profile'])->name('profile');
        Route::get('home', [AuthController::class, 'home'])->name('home');
        //    Route::match(['get', 'post'], 'profile', [AuthController::class, 'profile'])->name('profile');
    });
});
Route::group([
    'middleware' => ['auth'], // ['guest', 'web'],
    'prefix' => 'auth'
], function ($router) {
});
