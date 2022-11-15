<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\UserController;

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

Route::get('/home', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/home/{id}', [App\Http\Controllers\UserController::class, 'show']);
Route::get('/home/edit/{id}', [App\Http\Controllers\UserController::class, 'edit']);
Route::put('/home/update/{id}', [App\Http\Controllers\UserController::class, 'update']);


Route::get('/cursos',[App\Http\Controllers\CursoController::class, 'index']);
Route::get('/cursos/{id}',[App\Http\Controllers\CursoController::class, 'show']);
Route::get('/cursos/join/{id}',[App\Http\Controllers\CursoController::class, 'join'])->middleware('auth');
