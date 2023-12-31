<?php

namespace App\Http\Controllers;

use App\Livewire\EvaluationsTable;
use App\Models\DepartmentConfiguration;
use App\Models\Employee;
use App\Models\Evaluation;
use App\Models\EvaluationApprovers;
use App\Models\EvaluationPoint;
use App\Models\EvaluationTemplate;
use App\Models\Factor;
use App\Models\FactorRatingScale;
use App\Models\Part;
use App\Models\RatingScale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use PDF;

class EvaluationController extends Controller
{

    public function index()
    {

        //    Livewire::component('evaluations-table', EvaluationsTable::class);

        return view('evaluations.index');
    }

    public function deleteEvaluation(Request $request, $id)
    {
        $evaluation = Evaluation::find($id);

        // Check if the current user is the evaluator
        if ($evaluation && $evaluation->evaluator_id == Auth::user()->employee_id) {
            // Delete the evaluation
            $evaluation->delete();

            // Delete associated EvaluationPoints
            EvaluationPoint::where('evaluation_id', $evaluation->id)->delete();

            // Optionally, you can return a response if needed
            return response()->json(['message' => 'Evaluation deleted successfully']);
        } else {
            // Optionally, you can add an error message or perform other actions if the user is not authorized to delete
            return response()->json(['message' => 'You are not authorized to delete this evaluation.'], 403);
        }
    }

    //create evaluation for employee
    public function create($employee, $template)
    {
        $employee = Employee::where('employee_id', $employee)->firstOrFail();

        $template = EvaluationTemplate::find($template);

        if (!$employee || !$template) {
            // Handle the case where the employee or template does not exist
            // You can redirect or show an error message
        }

        $templateName = $template->name;

        return view('evaluations.create', compact('employee', 'templateName', 'template'));
    }


    public function selectTemplate($employeeId)
    {

        $employee = Employee::where('employee_id', $employeeId)->firstOrFail();

        // Fetch evaluation templates from the database
        $evaluationTemplates = EvaluationTemplate::where('status', 1)->get();

        // Pass the templates to the view
        return view('evaluations.select-template', [
            'employee' => $employee,
            'employeeId' => $employeeId,
            'evaluationTemplates' => $evaluationTemplates,
        ]);
    }
    public function review(Evaluation $evaluation)
    {
        $evaluation->load('evaluationTemplate');

        return view('evaluations.review', compact('evaluation'));
    }


    public function edit(Evaluation $evaluation)
    {
        $evaluation->load('evaluationTemplate');

        return view('evaluations.edit', compact('evaluation'));
    }
    public function generatePDF($evaluationId)
    {
        // Load the evaluation data using the method
        $evaluationData = $this->loadEvaluationData($evaluationId);
        $evaluation = Evaluation::find($evaluationId);
        $employee = $evaluation->employee;
        $templateName = $evaluation->evaluationTemplate->name;
        $name = $employee->last_name . '_' . $employee->first_name;
        // Check if the evaluation data is not found
        if (!$evaluationData) {
            // Handle the case where the evaluation does not exist
            // You can redirect or show an error message
        }

        // Load the evaluation data into the PDF view
        $pdf = PDF::loadView('evaluations.evaluation-pdf', $evaluationData);
        $pdf->setPaper('A4', 'portrait');




        // Add a page break in the PDF



        return $pdf->download($name . '-' . $templateName . '_PES.pdf');
    }

    public $selectedValues = [];
    public $selectedScale = [];
    public $factorNotes = [];
    private function loadEvaluationData($evaluationId)
    {
        // Fetch the evaluation by ID
        $evaluation = Evaluation::find($evaluationId);

        // Check if the evaluation is not found
        if (!$evaluation) {
            return null;
        }

        // Load additional data as needed (similar to the Livewire mount method)
        $employee = $evaluation->employee;
        $departmentName = $employee->department->name;
        $employeeIdCompany = $employee->employee_id;
        $name = $employee->first_name . ' ' . $employee->last_name;
        $position = $employee->position;
        $dateHired = $employee->date_hired;
        $createdAt = Carbon::parse($evaluation->created_at)->toDateTimeString();

        $ratingScales = RatingScale::all();

        $department = $evaluation->employee->department;
        $branch = $evaluation->employee->branch; // Corrected typo: 'brahcn' to 'branch'

        $departmentConfig = DepartmentConfiguration::where('department_id', $department->id)->where('branch_id', $branch->id)->first();
        $departmentConfigId = optional($departmentConfig)->id;

        // Check if $evaluationApprovers is null
        $isDepartmentConfigNull = is_null($departmentConfig);
        // Use conditional check to prevent accessing id property on null object
        $evaluationApprovers = $isDepartmentConfigNull
            ? collect()  // Provide an empty collection if $departmentConfig is null
            : EvaluationApprovers::where('department_configuration_id', $departmentConfigId)->get();

        // Access the number_of_approvers or set it to a default value (e.g., 0) if not found
        $departmentApproversCount = $departmentConfig ? $departmentConfig->number_of_approvers : 0;

        // Load other data as needed...

        $parts = Part::where('evaluation_template_id', $evaluation->evaluation_template_id)->get();
        $partsWithFactors = [];
        $totalRateForAllParts = 0; // Initialize the total rate for all parts
        $part1TotalFactors = 0; // Variable to store the count of factors for the first part

        foreach ($parts as $index => $part) {
            $factors = Factor::where('part_id', $part->id)->get();
            $factorsData = [];
            $totalRateForPart = 0; // Initialize the total rate for the part

            foreach ($factors as $factor) {
                // Load factor data as needed...
                $factorData = [
                    'factor' => $factor,
                    'rating_scales' => FactorRatingScale::where([
                        'evaluation_template_id' => $evaluation->evaluation_template_id,
                        'part_id' => $part->id,
                        'factor_id' => $factor->id,
                    ])->get()->map(function ($scale) {
                        $ratingScale = RatingScale::find($scale->rating_scale_id);
                        $scale->acronym = $ratingScale->acronym;
                        $scale->name = $ratingScale->name; // Include the rating scale name
                        return $scale;
                    })
                ];

                $evaluationPoint = EvaluationPoint::where([
                    'evaluation_id' => $evaluation->id,
                    'part_id' => $part->id,
                    'factor_id' => $factor->id,
                ])->first();

                $pointsForFactor = $evaluationPoint ? $evaluationPoint->points : 0;
                $noteForFactor = $evaluationPoint ? $evaluationPoint->note : '';
                $selectedScaleForFactor = $evaluationPoint ? $evaluationPoint->rating_scale_id : 0;

                $this->selectedValues[$factor->id] = $pointsForFactor;
                $this->selectedScale[$factor->id] = $selectedScaleForFactor;
                $this->factorNotes[$factor->id] = $noteForFactor;

                // Include the rating_scale_id for the factor
                $ratingScaleIdForFactor = $selectedScaleForFactor;

                $totalRateForPart += $pointsForFactor;

                // Add the points for the factor to the $factorData array
                $factorData['points'] = $pointsForFactor;
                $factorData['note'] = $noteForFactor;
                $factorData['selectedScale'] = $selectedScaleForFactor;
                $factorData['ratingScaleId'] = $ratingScaleIdForFactor; // Include rating_scale_id

                $factorsData[] = $factorData;
            }

            // If it's the first part, update the count of factors
            if ($index === 0) {
                $part1TotalFactors = count($factors);
            }

            $partsWithFactors[] = [
                'part' => $part,
                'factors' => $factorsData,
                'totalRate' => $totalRateForPart, // Include the total rate in the array

                // Add other part data as needed...
            ];

            $totalRateForAllParts += $totalRateForPart;
        }

        $isApproverLevelValid = ($evaluation->status != 2 && $evaluation->approver_count >= 0);

        if (
            $evaluation->approver_count >= 0
        ) {
            $departmentConfig = DepartmentConfiguration::where('department_id', $evaluation->employee->department_id)
                ->where('branch_id', $evaluation->employee->branch_id)
                ->first();

            $maxApproverLevel = $departmentConfig ? $departmentConfig->number_of_approvers : 0;

            $currentUserEmployeeId = auth()->user()->employee_id;
            $currentUserApprover = EvaluationApprovers::where('employee_id', $currentUserEmployeeId)
                ->where('department_configuration_id', $departmentConfig->id)
                ->first();

            if ($currentUserApprover) {
                // Check if the current user's approver level matches the expected level
                if ($currentUserApprover->approver_level == $evaluation->approver_count + 1) {
                    $isApproverLevelValid = true;
                } else {
                    $isApproverLevelValid = false;
                }
            }
        }


        // Return an associative array with the loaded data
        return [
            'evaluation' => $evaluation,
            'employee' => $employee,
            'departmentName' => $departmentName,
            'employeeIdCompany' => $employeeIdCompany,
            'name' => $name,
            'position' => $position,
            'dateHired' => $dateHired,
            'createdAt' => $createdAt,
            'ratingScales' => $ratingScales,
            'partsWithFactors' => $partsWithFactors, // Include the partsWithFactors array
            'totalRateForAllParts' => $totalRateForAllParts, // Include the total rate for all parts
            'selectedScale' => $this->selectedScale,
            'factorsData' => $factorsData, // Include the factorsData array
            'part1TotalFactors' => $part1TotalFactors, // Variable for the count of factors for the first part
            'departmentApproversCount' => $departmentApproversCount, // Pass the count to the view
            'evaluationApprovers' => $evaluationApprovers,
            'isApproverLevelValid' => $isApproverLevelValid,
            'maxApproverLevel' => $maxApproverLevel, // Include maxApproverLevel in the data array

            // Add other data as needed...
        ];
    }
}
