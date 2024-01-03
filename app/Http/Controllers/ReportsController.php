<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function recommended()
    {

        return view('reports.reco-employees');
    }


    public function evaluated()
    {

        return view('reports.list-evaluated');
    }


    public function evaluationList()
    {

        return view('reports.list-evaluation');
    }
}
