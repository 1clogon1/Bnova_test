<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/guest/{id}', [UserController::class, 'getGuest']);
Route::post('/guest', [UserController::class, 'addGuest']);
Route::put('/guest/{id}',  [UserController::class, 'updateGuest']);
Route::delete('/guest/{id}',  [UserController::class, 'deleteGuest']);
