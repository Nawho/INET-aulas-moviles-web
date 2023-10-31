<?php

namespace App\Http\Controllers\DB;

use App\Models\AulaMovilOverview;
use App\Models\AulaMovilDetails;
use App\Http\Controllers\Controller;

class AulasMovilesController extends Controller
{
    public function getAllAulasMovilesOverview()
    {
        $aulasMovilesOverview = AulaMovilOverview::with("ubicaciones")->get();

        // Iterate through each record and include the accessor field in the result
        $aulasMovilesOverview->each(function ($aulaMovil) {
            $aulaMovil->provincia_localidad = $aulaMovil->provincia_localidad;
        });

        return response()->json($aulasMovilesOverview, 200);
    }

    public function getAulaMovilDetails($id)
    {
        $aulaMovilDetails = AulaMovilDetails::find($id);
        return response()->json($aulaMovilDetails, 200);
    }
}
