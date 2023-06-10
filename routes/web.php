<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/add-stock', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/product-edit', [App\Http\Controllers\UserController::class, 'productEdit']);
Route::get('/search', [App\Http\Controllers\UserController::class, 'search']);

Route::post('/add-stock/store', [App\Http\Controllers\UserController::class, 'storeProduct']);
Route::post('/stock/edit', [App\Http\Controllers\UserController::class, 'editProduct']);
