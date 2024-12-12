<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UsersController;


Route::group([
    'prefix' => 'v1'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::group(['prefix' => 'auth', 'middleware' => 'api'], function () {
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    });
    Route::group(['prefix' => 'user', 'middleware' => 'api'], function () {
        Route::get('/', [UsersController::class, 'index'])->middleware('auth:api');
        Route::get('/getByID/{id}', [UsersController::class, 'getByID'])->middleware('auth:api');
        Route::post('/store', [UsersController::class, 'store'])->middleware('auth:api');
        Route::post('/update', [UsersController::class, 'store'])->middleware('auth:api');
        Route::delete('/delete/{id}', [UsersController::class, 'delete'])->middleware('auth:api');
    });
});
