<?php

Route::get('token', [\App\Http\Controllers\Api\V1\TokenController::class, 'getToken']);

Route::post('register', [\App\Http\Controllers\Api\V1\RegisterController::class, 'register'])
    ->middleware('token.check');

Route::resource('users', \App\Http\Controllers\Api\V1\UserController::class)
    ->only('index', 'show');

Route::resource('positions', \App\Http\Controllers\Api\V1\PositionController::class)
    ->only('index');
