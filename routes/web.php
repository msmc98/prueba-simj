<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DiaFestivoController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// users
Route::get('/usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
// Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
Route::post('/usuarios', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
Route::get('/usuarios/{user}', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
// Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
Route::put('/usuarios/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
Route::delete('/usuarios/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');


// dias festivos
Route::get('/dias-festivos', [App\Http\Controllers\DiaFestivoController::class, 'index'])->name('dias-festivos.index');
// Route::get('/dias-festivos/create', [App\Http\Controllers\DiaFestivoController::class, 'create'])->name('dias-festivos.create');
Route::post('/dias-festivos', [App\Http\Controllers\DiaFestivoController::class, 'store'])->name('dias-festivos.store');
// Route::get('/dias-festivos/{diaFestivo}', [App\Http\Controllers\DiaFestivoController::class, 'show'])->name('dias-festivos.show');
// Route::get('/dias-festivos/{diaFestivo}/edit', [App\Http\Controllers\DiaFestivoController::class, 'edit'])->name('dias-festivos.edit');
Route::put('/dias-festivos/{diaFestivo}', [App\Http\Controllers\DiaFestivoController::class, 'update'])->name('dias-festivos.update');
Route::delete('/dias-festivos/{diaFestivo}', [App\Http\Controllers\DiaFestivoController::class, 'destroy'])->name('dias-festivos.destroy');


//api
Route::get('/api/dias-festivos', [App\Http\Controllers\DiaFestivoController::class, 'apiGet'])->name('dias-festivos.apiGet');
