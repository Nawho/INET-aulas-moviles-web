<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DB\AulasMovilesController;

Route::get('/', function () {
    return view('home', [
        'articles' =>
            ['Article 1', 'Article 2', 'Article 3']
    ]);
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

Route::get('/aulas-moviles-overview', [AulasMovilesController::class, 'getAllAulasMovilesOverview']);
Route::get('/aula-movil-details/{id}', [AulasMovilesController::class, 'getAulaMovilDetails']);
Route::get('/aulas-moviles-overview/especialidad/{especialidad}', [AulasMovilesController::class, 'filterByEspecialidadFormativa']);
Route::get('/aulas-moviles-overview/provincia/{provincia}', [AulasMovilesController::class, 'filterByProvincia']);
