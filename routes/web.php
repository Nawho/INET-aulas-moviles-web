<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/map', function () {
    return view('map');
});

Route::get('/list', function () {
    return view('list');
});

Route::get('/aula/{n_aula}', function ($n_aula) {
    return view('aula', ['n_aula' => $n_aula]);
});


