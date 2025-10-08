<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [PropertyController::class, 'home'])->name('home');
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{id}', [PropertyController::class, 'show'])->name('properties.show');

// Admin panel
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('agents', AgentController::class)->only(['index', 'edit', 'update', 'destroy']);
    Route::resource('clients', ClientController::class)->only(['index', 'edit', 'update', 'destroy']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {

    Route::post('/properties/{id}/purchase', [PropertyController::class, 'purchase'])->name('properties.purchase');

    // profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
