<?php

use App\Http\Controllers\DaysController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Ruta para mostrar el formulario de inicio de sesión
Route::get('/', function () {
    return view('auth.login');
});

// Rutas de autenticación (inicio de sesión, registro, etc.)
Auth::routes();

// Ruta para la página de inicio después de iniciar sesión
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Rutas relacionadas con los días
Route::get('/days', [App\Http\Controllers\DaysController::class, 'index'])->name('days.index');
Route::get('/days/create', [App\Http\Controllers\DaysController::class, 'create'])->name('days.create');
Route::post('/days', [App\Http\Controllers\DaysController::class, 'store'])->name('days.store');
Route::get('/days/{day}/edit', [App\Http\Controllers\DaysController::class, 'edit'])->name('days.edit');
Route::patch('/days/{day}', [App\Http\Controllers\DaysController::class, 'update'])->name('days.update');
Route::delete('/days/{day}', [App\Http\Controllers\DaysController::class, 'destroy'])->name('days.destroy');

Route::resource("/users", UserController::class);
Route::get('/user/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
Route::patch('/user/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');









