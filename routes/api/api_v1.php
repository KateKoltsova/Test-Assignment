<?php

Route::resource('users', \App\Http\Controllers\Api\V1\UserController::class)
    ->only('index', 'show');

Route::resource('positions', \App\Http\Controllers\Api\V1\PositionController::class)
    ->only('index');
