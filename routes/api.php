<?php

use App\Http\Controllers\Api\AnnonceController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CandidatureController;
use App\Http\Controllers\Api\StatistiqueController;
use Illuminate\Support\Facades\Route;

Route::get('/annonces', [AnnonceController::class, 'index']);
Route::get('/annonces/{id}', [AnnonceController::class, 'show']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
   
    Route::post('/annonces', [AnnonceController::class, 'store']);
    Route::put('/annonces/{id}', [AnnonceController::class, 'update']);
    Route::delete('/annonces/{id}', [AnnonceController::class, 'destroy']);
  
    Route::get('/candidatures', [CandidatureController::class, 'index']);
    Route::get('/candidatures/{id}', [CandidatureController::class, 'show']);
    Route::post('/candidatures', [CandidatureController::class, 'store']);
    Route::patch('/candidatures/{id}/status', [CandidatureController::class, 'updateStatus']);
    Route::delete('/candidatures/{id}', [CandidatureController::class, 'destroy']);
    
    Route::get('/statistiques/recruteur', [StatistiqueController::class, 'recruteur']);
    Route::get('/statistiques/global', [StatistiqueController::class, 'global']);
});