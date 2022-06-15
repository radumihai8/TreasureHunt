<?php

use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('rooms',\App\Http\Controllers\RoomController::class);
Route::resource('game',\App\Http\Controllers\RoomUserController::class);
Route::resource('question',\App\Http\Controllers\QuestionController::class);

Route::post('/answer', [QuestionController::class, 'answer']);
