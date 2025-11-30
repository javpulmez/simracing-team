<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/drivers', [HomeController::class, 'drivers'])->name('drivers.public');
Route::get('/news', [HomeController::class, 'news'])->name('news.public');
Route::get('/news/{news}', [HomeController::class, 'showNews'])->name('news.show.public');

// Rutas autenticadas
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rutas de recursos con middleware de autorización
    Route::resource('drivers', DriverController::class)->except(['index', 'show']);
    Route::resource('races', RaceController::class);
    Route::resource('documents', DocumentController::class);
    Route::resource('news', NewsController::class);
    
    // Rutas adicionales para carreras
    Route::post('/races/{race}/register', [RaceController::class, 'register'])->name('races.register');
    Route::delete('/races/{race}/unregister', [RaceController::class, 'unregister'])->name('races.unregister');
});

require __DIR__.'/auth.php';