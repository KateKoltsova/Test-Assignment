<?php

Route::resource('users', \App\Http\Controllers\Api\V1\UserController::class)
    ->only('index');
