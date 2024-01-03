<?php

namespace App\Http\Controllers;

use App\Exports\ActiveUserExports;
use App\Models\Employee;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ReportsController extends Controller
{
    public function recommended()
    {
        // Fetch employees with at least one recommendation
        $employeesWithRecommendations = Employee::has('recommendations')
            ->withCount('recommendations')
            ->get()
            ->sortByDesc('recommendations_count');

        return view('reports.reco-employees', compact('employeesWithRecommendations'));
    }

    public function downloadExcel()
    {
        $export = new ActiveUserExports();

        return Excel::download($export, 'recommended_employees.xlsx');
    }
    public function downloadPdf()
    {
        $employeesWithRecommendations = Employee::has('recommendations')
            ->with(['recommendations', 'department']) // Load the recommendations and department relationships
            ->get()
            ->sortByDesc(function ($employee) {
                return $employee->recommendations->count();
            });

        $pdf = PDF::loadView('pdf.recommended_employees', compact('employeesWithRecommendations'));

        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('recommended_employees.pdf');
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
