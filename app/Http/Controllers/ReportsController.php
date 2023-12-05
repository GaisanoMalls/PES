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
        // Retrieve recommended employees with the count of recommendations
        $recommendedEmployees = Employee::leftJoin('recommendations', 'employees.id', '=', 'recommendations.employee_id')
            ->select('employees.*', DB::raw('COUNT(recommendations.id) as recommendation_count'))
            ->groupBy('employees.id')
            ->having('recommendation_count', '>', 0)
            ->get();

        return view('reports.reco-employees', ['employees' => $recommendedEmployees]);
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
