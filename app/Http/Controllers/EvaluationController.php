<?php

namespace App\Http\Controllers;

use App\Livewire\EvaluationsTable;
use App\Models\Employee;
use App\Models\Evaluation;
use App\Models\EvaluationPoint;
use App\Models\EvaluationTemplate;
use Illuminate\Http\Request;
use Livewire\Livewire;
use PDF;

class EvaluationController extends Controller
{

    public function index()
    {
        Livewire::component('evaluations-table', EvaluationsTable::class);

        return view('evaluations.index');
    }
    //create evaluation for employee
    public function create($employee, $template)
    {
        $employee = Employee::find($employee);
        $template = EvaluationTemplate::find($template);

        if (!$employee || !$template) {
            // Handle the case where the employee or template does not exist
            // You can redirect or show an error message
        }

        $templateName = $template->name;

        return view('evaluations.create', compact('employee', 'templateName', 'template'));
    }

    public function generatePDF($evaluationId)
    {
        $evaluation = Evaluation::find($evaluationId);

        if (!$evaluation) {
            // Handle the case where the evaluation does not exist
            // You can redirect or show an error message
        }

        // Load the evaluation into the PDF view
        $pdf = PDF::loadView('evaluations.evaluation-pdf', compact('evaluation'));

        return $pdf->download('evaluation.pdf');
    }
}
