<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

// Authenticated routes
Route::middleware(['web', 'auth'])->group(function () {

    // Admin-only routes
    Route::middleware('isAdmin')->group(function () {
        Route::resource('agents', AgentController::class)->only(['index', 'edit', 'update', 'destroy']);
        Route::resource('clients', ClientController::class)->only(['index', 'edit', 'update', 'destroy']);
    });

    Route::middleware(['web', 'auth', 'isAgentOrAdmin'])->group(function () {
        Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
        Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
        Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
        Route::patch('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
        Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');
    });

    // Purchase & Profile
    Route::post('/properties/{id}/purchase', [PropertyController::class, 'purchase'])->name('properties.purchase');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Public routes
Route::middleware('web')->group(function () {
    Route::get('/', [PropertyController::class, 'home'])->name('home');
    Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
    Route::get('/properties/{id}', [PropertyController::class, 'show'])->name('properties.show');
});

require __DIR__ . '/auth.php';
