<?php

use App\Http\Controllers\GlobalBotController as BotController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);

Route::get('/map', function () {
    return view('map');
});

Route::get('/list', function () {
    return view('list');
});

Route::get('/aula-movil-demo', function () {
    return view('aula_movil_demo');
});