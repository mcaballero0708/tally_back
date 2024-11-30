<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::prefix('api')->group(function () {
//    \App\Http\Controllers\AuthController::routes();
//    \App\Http\Controllers\UserController::routes();
//    \App\Http\Controllers\PostController::routes();
//});
