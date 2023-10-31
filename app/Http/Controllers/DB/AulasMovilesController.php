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
        return response()->json($aulasMovilesOverview, 200);
    }

    public function getAulaMovilDetails($id)
    {
        $aulaMovilDetails = AulaMovilDetails::find($id);
        return response()->json($aulaMovilDetails, 200);
    }
}
