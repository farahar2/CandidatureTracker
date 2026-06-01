<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Page d'accueil publique
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Routes protégées par auth
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profil (généré par Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Candidatures — routes custom (avant resource)
    Route::get('/applications/archived', [ApplicationController::class, 'archived'])
        ->name('applications.archived');

    Route::patch('/applications/{application}/restore', [ApplicationController::class, 'restore'])
        ->name('applications.restore')
        ->withTrashed();

    // Candidatures — CRUD complet
    Route::resource('applications', ApplicationController::class);
});

require __DIR__.'/auth.php';