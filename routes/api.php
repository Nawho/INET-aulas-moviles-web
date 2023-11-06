<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Bot\GlobalBotController;
use App\Http\Controllers\DB\AulasMovilesController;

Route::match(['get', 'post'], '/botman', GlobalBotController::class);
Route::get('/aulas-moviles-overview-map', [AulasMovilesController::class, 'getAllAulasMovilesMapOverview']);
Route::get('/aulas-moviles-overview-list', [AulasMovilesController::class, 'getAllAulasMovilesListOverview']);
Route::get('/aula-movil-details/{id}', [AulasMovilesController::class, 'getAulaMovilDetails']);
