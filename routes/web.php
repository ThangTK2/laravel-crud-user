<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('auth'); //->middleware('auth'): phai dang nhap moi vao xem duoc
Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware('auth');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store')->middleware('auth');

Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('auth');
Route::put('/users/{id}/update', [UserController::class, 'update'])->name('users.update')->middleware('auth');
Route::delete('/users/{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy')->middleware('auth');
