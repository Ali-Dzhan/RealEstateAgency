<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [PropertyController::class, 'home'])->name('home');
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{id}', [PropertyController::class, 'show'])->name('properties.show');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/properties/{id}/purchase', [PropertyController::class, 'purchase'])->name('properties.purchase');
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
