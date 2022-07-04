<?php

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
    return redirect('login');
});
Route::resource('/todo', \App\Http\Controllers\TodolistController::class)->middleware('auth')->except('destroy');
Route::post('/todo/delete', [\App\Http\Controllers\TodolistController::class, 'delete'])->middleware('auth');
Route::put('/todo/update', [\App\Http\Controllers\TodolistController::class, 'update'])->middleware('auth');


Route::get('/update',[\App\Http\Controllers\TodolistController::class, 'edit'])->middleware('auth');;
Route::post('/update',[\App\Http\Controllers\TodolistController::class, 'edit'])->middleware('auth');;
//Route::get('/todo/edit',[\App\Http\Controllers\TodolistController::class, 'edit']);
//Route::post('/todo/edit',[\App\Http\Controllers\TodolistController::class, 'edit']);

require __DIR__.'/auth.php';
