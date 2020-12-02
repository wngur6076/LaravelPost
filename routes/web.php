<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', IndexController::class);

Route::get('/auth/login', [ AuthController::class, 'showLoginForm' ]);
Route::post('/auth', [ AuthController::class, 'login' ]);
Route::get('/auth/logout', [ AuthController::class, 'logout' ]);

Route::get('/users/register', [ UserController::class, 'create' ]);
Route::post('/users', [ UserController::class, 'store' ]);
