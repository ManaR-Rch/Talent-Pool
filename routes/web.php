<?php

use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/annonces', [AnnonceController::class, 'index'])->name('annonces.index');
Route::get('/annonces/{id}', [AnnonceController::class, 'show'])->name('annonces.show');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
   
    Route::middleware(['can:access-recruteur'])->group(function () {
        Route::get('/annonces/create', [AnnonceController::class, 'create'])->name('annonces.create');
        Route::post('/annonces', [AnnonceController::class, 'store'])->name('annonces.store');
        Route::get('/annonces/{id}/edit', [AnnonceController::class, 'edit'])->name('annonces.edit');
        Route::put('/annonces/{id}', [AnnonceController::class, 'update'])->name('annonces.update');
        Route::delete('/annonces/{id}', [AnnonceController::class, 'destroy'])->name('annonces.destroy');
        Route::patch('/annonces/{id}/toggle-status', [AnnonceController::class, 'toggleStatus'])->name('annonces.toggle-status');
        Route::get('/annonces/{id}/candidatures', [AnnonceController::class, 'candidatures'])->name('annonces.candidatures');
        Route::patch('/candidatures/{id}/status', [CandidatureController::class, 'updateStatus'])->name('candidatures.update-status');
        Route::patch('/candidatures/{id}/notes', [CandidatureController::class, 'updateNotes'])->name('candidatures.update-notes');
    });
    
   
    Route::middleware(['can:access-candidat'])->group(function () {
        Route::get('/candidatures', [CandidatureController::class, 'index'])->name('candidatures.index');
        Route::get('/candidatures/{id}', [CandidatureController::class, 'show'])->name('candidatures.show');
        Route::get('/annonces/{annonceId}/postuler', [CandidatureController::class, 'create'])->name('candidatures.create');
        Route::post('/annonces/{annonceId}/postuler', [CandidatureController::class, 'store'])->name('candidatures.store');
        Route::delete('/candidatures/{id}', [CandidatureController::class, 'destroy'])->name('candidatures.destroy');
    });
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
