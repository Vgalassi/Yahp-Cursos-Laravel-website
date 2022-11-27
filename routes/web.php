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

Auth::routes(['register' => false]);;

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index']);

Route::delete('/admin/deleteuser/{id}', [App\Http\Controllers\AdminController::class, 'delete_user']);
Route::delete('/admin/deletecurso/{id}', [App\Http\Controllers\AdminController::class, 'delete_curso']);
Route::delete('/admin/show/dettachalu/{cursoid}/{aluid}', [App\Http\Controllers\CursoController::class, 'leave'])->middleware('auth');
Route::get('/admin/show/attachalu/{id}',[App\Http\Controllers\AdminController::class, 'join'])->middleware('auth');
Route::get('/admin/show/{id}', [App\Http\Controllers\AdminController::class, 'show_curso']);
Route::get('/admin/show/close/{id}', [App\Http\Controllers\AdminController::class, 'close']);
Route::get('/admin/show/open/{id}', [App\Http\Controllers\AdminController::class, 'open']);
Route::get('/admin/editcurso/{id}', [App\Http\Controllers\AdminController::class, 'edit_curso']);
Route::put('/admin/updatecurso/{id}', [App\Http\Controllers\AdminController::class, 'update_curso']);
Route::get('/admin/editalu/{id}', [App\Http\Controllers\UserController::class, 'edit']);
Route::get('/admin/editprof/{id}', [App\Http\Controllers\ProfController::class, 'edit']);
Route::get('/admin/linkprof', [App\Http\Controllers\AdminController::class, 'linkprof']);
Route::get('/admin/linkprof/attach', [App\Http\Controllers\AdminController::class, 'attachprof']);
Route::get('/admin/linkprof/dettach/{id}', [App\Http\Controllers\AdminController::class, 'dettachprof']);
Route::get('/admin/create', [App\Http\Controllers\AdminController::class, 'create']);
Route::post('/admin/create/createalu', [App\Http\Controllers\AdminController::class, 'create_alu']);
Route::post('/admin/create/createprof', [App\Http\Controllers\AdminController::class, 'create_prof']);
Route::post('/admin/create/createcurso', [App\Http\Controllers\AdminController::class, 'create_curso']);
Route::get('/admin/editpassword/{id}', [App\Http\Controllers\UserController::class, 'editpassword']);
Route::put('/admin/updatepassword/{id}', [App\Http\Controllers\UserController::class, 'updatepassword']);
Route::get('/admin/changeuser/{id}', [App\Http\Controllers\AdminController::class, 'user_password']);
Route::put('/admin/updateuserpassword/{id}', [App\Http\Controllers\AdminController::class, 'upuser_password']);
Route::get('/admin/show/beprofessor/{id}', [App\Http\Controllers\AdminController::class, 'beprofessor']);


Route::get('/professor', [App\Http\Controllers\ProfController::class, 'index']);
Route::post('/professor/notas/{cursoid}/{aluid}', [App\Http\Controllers\ProfController::class, 'notas']);
Route::get('/professor/{id}', [App\Http\Controllers\UserController::class, 'show']);
Route::get('/professor/edit/{id}', [App\Http\Controllers\ProfController::class, 'edit']);
Route::put('/professor/update/{id}', [App\Http\Controllers\UserController::class, 'update']);
Route::get('/professor/edit/password/{id}', [App\Http\Controllers\UserController::class, 'editpassword']);


Route::get('/home', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/home/{id}', [App\Http\Controllers\UserController::class, 'show']);
Route::get('/home/edit/{id}', [App\Http\Controllers\UserController::class, 'edit']);
Route::get('/home/edit/password/{id}', [App\Http\Controllers\UserController::class, 'editpassword']);
Route::put('/home/update/{id}', [App\Http\Controllers\UserController::class, 'update']);

Route::put('/home/update/password/{id}', [App\Http\Controllers\UserController::class, 'updatepassword']);


Route::get('/cursos',[App\Http\Controllers\CursoController::class, 'index']);
Route::get('/cursos/{id}',[App\Http\Controllers\CursoController::class, 'show']);
Route::get('/cursos/join/{id}',[App\Http\Controllers\CursoController::class, 'join'])->middleware('auth');
Route::delete('/cursos/leave/{cursoid}/{aluid}',[App\Http\Controllers\CursoController::class, 'leave'])->middleware('auth');
