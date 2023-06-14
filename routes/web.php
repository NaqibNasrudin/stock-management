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
Route::get('/users', [App\Http\Controllers\UserController::class, 'users']);
Route::get('/approve/{id}', [App\Http\Controllers\UserController::class, 'approve']);
Route::get('/reject/{id}', [App\Http\Controllers\UserController::class, 'reject']);

Route::post('/add-stock/store', [App\Http\Controllers\UserController::class, 'storeProduct']);
Route::post('/stock/edit', [App\Http\Controllers\UserController::class, 'editProduct']);
Route::get('/change-role', [App\Http\Controllers\UserController::class, 'changeRole']);
