<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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

Route::resource('songs', SongController::class)->only('index');

Route::group(['middleware' => ['guest']], function () {
  Route::get('/', [Controller::class, 'index'])->name('index');
  Route::get('/login', [Controller::class, 'login'])->name('login');
  Route::get('/authenticate', [Controller::class, 'authenticate'])->name('authenticate');
});

Route::group(['middleware' => ['auth']], function () {
  Route::get('/logout', [Controller::class, 'logout'])->name('logout');
  Route::resource('users', UserController::class)->only('show', 'update');

  Route::group(['middleware' => ['client']], function () {
    Route::resource('carts', CartController::class)->only('store', 'index', 'destroy');
    Route::resource('transactions', TransactionController::class)->only('store');

    Route::get('pendings/index/{user}', [TransactionController::class, 'pendings'])->name('pendings.index');
  });

  Route::group(['middleware' => ['administrators']], function () {
    Route::resource('songs', SongController::class)->only('store', 'update', 'destroy');
    Route::resource('users', UserController::class)->only('index', 'destroy');

    Route::resource('transactions', TransactionController::class)->only('index', 'update');
  });

});

Route::resource('users', UserController::class)->only('store');
