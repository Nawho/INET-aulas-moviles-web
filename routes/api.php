<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Bot\GlobalBotController;
use App\Http\Controllers\DB\AulasMovilesController;

Route::match(['get', 'post'], '/botman', GlobalBotController::class);
Route::get('/aulas-moviles-overview', [AulasMovilesController::class, 'getAllAulasMovilesOverview']);
Route::get('/aula-movil-details/{id}', [AulasMovilesController::class, 'getAulaMovilDetails']);
