<?php

namespace App\Http\Controllers\DB;

use App\Models\AulaMovilOverview;
use App\Models\AulaMovilDetails;
use App\Http\Controllers\Controller;

class AulasMovilesController extends Controller
{
    static public function getAllAulasMovilesOverview()
    {
        $aulasMovilesOverview = AulaMovilOverview::with("ubicaciones")->get();
        return response()->json($aulasMovilesOverview, 200);
    }

    static public function getAulaMovilDetails($id)
    {
        $aulaMovilDetails = AulaMovilDetails::with(["ofertasFormativas", "contact", "ubicaciones"])->where('n_ATM', $id)->first();
        return response()->json($aulaMovilDetails, 200);
    }
}
