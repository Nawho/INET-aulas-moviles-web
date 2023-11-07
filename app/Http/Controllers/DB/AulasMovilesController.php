<?php

namespace App\Http\Controllers\DB;

use App\Models\AulaMovilListOverview;
use App\Models\AulaMovilMapOverview;
use App\Models\AulaMovilDetails;
use App\Http\Controllers\Controller;

class AulasMovilesController extends Controller
{
    static public function getAllAulasMovilesListOverview()
    {
        $aulasMovilesOverview = AulaMovilListOverview::with(["ubicaciones"])->get();
        return response()->json($aulasMovilesOverview, 200);
    }

    static public function getAllAulasMovilesMapOverview()
    {
        $aulasMovilesOverview = AulaMovilMapOverview::with(["ubicaciones", "ofertasFormativas"])->get();
        return response()->json($aulasMovilesOverview, 200);
    }

    static public function getAulaMovilDetails($id)
    {
        $aulaMovilDetails = AulaMovilDetails::with(["ofertasFormativas", "contact", "ubicaciones"])->where('n_atm', $id)->first();
        return response()->json($aulaMovilDetails, 200);
    }
}
