<?php

namespace App\Http\Controllers;

use App\Exports\ListEvaluatedEmployeeExports;
use App\Exports\ListEvaluations;
use App\Exports\RecoEmployeeExports;
use App\Models\Employee;
use App\Models\Evaluation;
use App\Models\EvaluationPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Livewire\WithPagination;

class ReportsController extends Controller
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function recommended()
    {
        // Fetch employees with at least one recommendation
        $employeesWithRecommendations = Employee::has('recommendations')
            ->withCount('recommendations')
            ->orderByDesc('recommendations_count')
            ->paginate(10); // You can adjust the number of items per page

        return view('reports.reco-employees', compact('employeesWithRecommendations'));
    }
    public function downloadExcel()
    {
        $export = new RecoEmployeeExports();

        return Excel::download($export, 'recommended_employees.xlsx');
    }
    public function downloadExcel2()
    {
        $export = new ListEvaluatedEmployeeExports();

        return Excel::download($export, 'evaluated_employees.xlsx');
    }

    public function downloadExcel3()
    {
        $export = new ListEvaluations();

        return Excel::download($export, 'evaluated_employees.xlsx');
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

    public function downloadPdf2()
    {
        $employeesEvaluated = Employee::has('evaluations')
            ->with(['evaluations', 'department']) // Load the recommendations and department relationships
            ->get()
            ->sortByDesc(function ($employee) {
                return $employee->evaluations->count();
            });

        $pdf = PDF::loadView('pdf.evaluated_employees', compact('employeesEvaluated'));

        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('evaluated_employees.pdf');
    }


    public function evaluated()
    {
        // Fetch employees with at least one evaluation
        $employeesEvaluated = Employee::has('evaluations')
            ->withCount('evaluations')
            ->orderByDesc('evaluations_count')
            ->paginate(10); // You can adjust the number of items per page

        return view('reports.list-evaluated', compact('employeesEvaluated'));
    }

    public function evaluationList()
    {
        $perPage = 10; // Replace with the desired number of items per page

        $evaluationsQuery = Evaluation::with('employee', 'evaluatorEmployee');
        $evaluationsQuery->orderBy('created_at', 'desc'); // Add this line to sort by the latest

        $evaluations = $evaluationsQuery->paginate($perPage);

        $evaluationTotals = [];

        foreach ($evaluations as $evaluation) {
            $totalRate = EvaluationPoint::where('evaluation_id', $evaluation->id)->sum('points');
            $evaluationTotals[$evaluation->id] = $totalRate;
        }

        return view('reports.list-evaluation', compact('evaluations', 'evaluationTotals'));
    }
}
