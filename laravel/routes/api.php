<?php

use App\Http\Controllers\GuestController;
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
// Получение
Route::get('/get/guest/{id?}', [GuestController::class, 'getGuest']);
// Создание
Route::post('/post/guest', [GuestController::class, 'addGuest']);
// Обновление
Route::put('/put/guest/{id}',  [GuestController::class, 'updateGuest']);
// Удаление
Route::delete('/delete/guest/{id}',  [GuestController::class, 'deleteGuest']);
