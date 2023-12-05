<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function recommended()
    {
        $evaluationsWithRecommendations = Evaluation::has('recommendation')->get();

        return view('reports.reco-employees', ['evaluations' => $evaluationsWithRecommendations]);
    }
}
