<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoteController;
use App\Http\Controllers\EpargneController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Routes publiques pour le calcul de la cote de crédit
Route::get('cote/{entrepriseId}/{months}', [CoteController::class, 'getCote']);
Route::get('/users/all', [CoteController::class, 'getUser']);
Route::get('/provision/{entrepriseId}', [CoteController::class, 'getProvisions']);
