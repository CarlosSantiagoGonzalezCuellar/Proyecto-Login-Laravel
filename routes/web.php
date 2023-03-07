<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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

Route::get('/', UserController::class);

Route::controller(UserController::class)->group(function () {
    Route::get('user/create', 'create');
    Route::get('user/delete', 'delete');
    Route::get('user/{opcion}', 'index');
});

Route::get('auth', [AuthController::class, 'index']);
