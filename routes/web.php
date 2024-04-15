<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/getToken', [\App\Http\Controllers\MainController::class, 'getToken'])->name('getToken');
Route::get('/register', [\App\Http\Controllers\MainController::class, 'showForm'])->name('form');
Route::post('/register', [\App\Http\Controllers\MainController::class, 'register'])->name('register');
Route::get('/users', [\App\Http\Controllers\MainController::class, 'usersList'])->name('users.list');
Route::get('/users/{id}', [\App\Http\Controllers\MainController::class, 'userById'])->name('users.view');
Route::get('/positions', [\App\Http\Controllers\MainController::class, 'positionsList'])->name('positions.list');

