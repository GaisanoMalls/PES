<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\DisapprovalReason;
use App\Models\Employee;
use App\Models\Evaluation;
use App\Models\EvaluationPoint;
use App\Models\Factor;
use App\Models\FactorRatingScale;
use App\Models\Part;
use App\Models\RatingScale;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Carbon\Carbon;


use Illuminate\Support\Facades\Mail;
use App\Mail\EmailNotification;
use App\Models\Clarification;

class ReviewEvaluation extends Component
{
    public $currentStep = 1;
    public $evaluation;
    public $employeeId;
    public $employee;
    public $departmentName;
    public $employeeIdCompany;
    public $name;
    public $position;
    public $date_hired;

    public $created_at;
    public $ratingScales;
    public $partsWithFactors;


    public $totalRates = [];
    public $ratingScaleNames = [];
    public $selectedValues = [];
    public $factorNotes = [];
    public $selectedScale = [];

    public $isFormSubmitted = false; // Add this property
    public $disapprovalDescription; // Add this property to store the disapproval description
    public $showClarificationSection = false;

    public $clarificationDescription;


    public function mount(Evaluation $evaluation)
    {

        $this->evaluation = $evaluation->load('evaluationTemplate');
        $this->loadEmployeeData();
        $this->loadRatingScales();
    }

    private function loadEmployeeData()
    {
        $this->employee = $this->evaluation->employee;
        $this->departmentName = $this->employee->department->name;
        $this->employeeIdCompany = $this->employee->employee_id;
        $this->name = $this->employee->first_name . ' ' . $this->employee->last_name;
        $this->position = $this->employee->position;
        $this->date_hired = $this->employee->date_hired;

        // Convert JSON string to a Carbon date instance
        $this->created_at = \Carbon\Carbon::parse($this->evaluation->created_at)->toDateTimeString();
    }
    public function displayClarificationSection()
    {
        $this->showClarificationSection = true;
    }

    private function loadRatingScales()
    {
        $this->ratingScales = RatingScale::all();
    }

    public function calculateTotalRate()
    {
        $totalRates = [];

        // Loop through each part and calculate the total rate for each part
        foreach ($this->partsWithFactors as $partWithFactors) {
            $partTotal = 0;

            // Loop through factors within each part and calculate their total rate
            foreach ($partWithFactors['factors'] as $factorData) {
                $factorId = $factorData['factor']->id;
                $selectedValue = $this->selectedValues[$factorId] ?? 0;

                // Ensure $selectedValue is always an integer
                if (is_array($selectedValue)) {
                    $partTotal += array_sum($selectedValue);
                } else {
                    $partTotal += (int) $selectedValue; // Convert to integer if not already
                }
            }

            // Store the total rate for this part
            $totalRates[$partWithFactors['part']->id] = $partTotal;
        }

        return $totalRates;
    }




    public function approveEvaluation()
    {
        if ($this->isFormSubmitted) {
            return;
        }

        $userEmployeeId = Auth::user()->employee_id;
        $this->evaluation->status = 2;
        $this->evaluation->approver_id = $userEmployeeId;
        $this->evaluation->save();
        $user = auth()->user();

        // Find the user who evaluated the performance
        $evaluator = User::where('employee_id', $this->evaluation->evaluator_id)->first();

        // Find all HR users (role_id = 5)
        $hrUsers = User::where('role_id', 5)->get();

        // Check if the evaluator is found
        if ($evaluator && $evaluator->email) {
            $dataEvaluator = [
                'subject' => 'Approved Evaluation ' . 'ID: ' . $this->evaluation->id,
                'body' => 'Evaluation for ' . $this->evaluation->employee->first_name . ' ' .    $this->evaluation->employee->last_name,

                // Add any additional data you want to pass to the email view
            ];

            // Send email to the evaluator
            Mail::to($evaluator->email)->send(new EmailNotification($dataEvaluator['body'], $dataEvaluator['subject']));
        }

        // Check if there are HR users
        if ($hrUsers->count() > 0) {
            $dataHR = [
                'subject' => 'Approved Evaluation ' . 'ID: ' . $this->evaluation->id,
                'body' => 'Evaluation for ' . $this->evaluation->employee->first_name . ' ' .    $this->evaluation->employee->last_name,
                // Add any additional data you want to pass to the email view
            ];

            // Send email to each HR user
            foreach ($hrUsers as $hrUser) {
                if ($hrUser->email) {
                    Mail::to($hrUser->email)->send(new EmailNotification($dataHR['body'], $dataHR['subject']));
                }
            }
        }

        $this->isFormSubmitted = true;

        return Redirect::to(route('evaluations.index'));
    }
    public function disapproveEvaluation()
    {
        if ($this->isFormSubmitted) {
            return;
        }
        $this->validate([
            'disapprovalDescription' => 'required|string', // Add validation rules if necessary
        ]);

        $this->evaluation->status = 3;
        $this->evaluation->save();
        $userEmployeeId = Auth::user()->employee_id;



        // Find the user who evaluated the performance
        $evaluator = User::where('employee_id', $this->evaluation->evaluator_id)->first();

        // Check if the evaluator is found
        if ($evaluator && $evaluator->email) {
            $dataEvaluator = [
                'subject' => 'Disapprove Evaluation ' . 'ID: ' . $this->evaluation->id,
                'body' => 'Reason of disapproval: ' . $this->disapprovalDescription,
                // Add any additional data you want to pass to the email view
            ];
            // Send email to the evaluator
            Mail::to($evaluator->email)->send(new EmailNotification($dataEvaluator['body'], $dataEvaluator['subject']));
        }


        // Store disapproval reason
        DisapprovalReason::create([
            'evaluation_id' => $this->evaluation->id,
            'approver_id' => $userEmployeeId, // Assuming the approver is the authenticated user
            'evaluator_id' => $this->evaluation->evaluator_id, // Assuming you have the evaluator ID available
            'description' => $this->disapprovalDescription, // Use the entered description
            'status' =>   $this->evaluation->status, // Set the status as needed
        ]);
        $this->isFormSubmitted = true;
        return redirect()->to(route('evaluations.index'));
    }

    public function submitClarification()
    {
        // Validate the input if necessary
        $this->validate([
            'clarificationDescription' => 'required|string',
        ]);
        $user = auth()->user();


        // Save the clarification to the database
        $clarification = new Clarification();
        $clarification->evaluation_id = $this->evaluation->id;
        $clarification->approver_id = $user->employee->id;
        $clarification->evaluator_id = $this->evaluation->evaluator_id;
        $clarification->description = $this->clarificationDescription;
        $clarification->commentor_id = $user->employee->id;
        $clarification->status = 4;
        $clarification->save();

        // Change the evaluation status
        $this->evaluation->status = 4;
        $this->evaluation->save();

        // Other logic if needed...

        // Clear the input field after submission
        $this->clarificationDescription = '';

        // Refresh the Livewire component or any other necessary action
        $this->dispatch('refreshComponent');
    }

    public function submitStep1()
    {
        $this->currentStep = 2;
    }


    public function goBack()
    {

        $this->currentStep = 1;
    }

    public function render()
    {
        $this->ratingScales = RatingScale::all();
        $clarifications = Clarification::where('evaluation_id', $this->evaluation->id)->get();

        $parts = Part::where('evaluation_template_id', $this->evaluation->evaluation_template_id)->get();
        $this->partsWithFactors = [];
        $totalRateForAllParts = 0; // Initialize the total rate for all parts

        foreach ($parts as $part) {
            $factors = Factor::where('part_id', $part->id)->get();
            $factorsData = [];
            $totalRateForPart = 0; // Initialize the total rate for the part

            foreach ($factors as $factor) {
                $factorData = [
                    'factor' => $factor,
                    'rating_scales' => FactorRatingScale::where([
                        'evaluation_template_id' =>
                        $this->evaluation->evaluation_template_id,
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
                    'evaluation_id' => $this->evaluation->id,
                    'part_id' => $part->id,
                    'factor_id' => $factor->id,
                ])->first();

                if ($evaluationPoint) {
                    $this->selectedValues[$factor->id] = $evaluationPoint->points;
                    $this->selectedScale[$factor->id] = $evaluationPoint->rating_scale_id;
                    $this->factorNotes[$factor->id] = $evaluationPoint->note;
                } else {
                    $this->selectedValues[$factor->id] = 0;
                    $this->selectedScale[$factor->id] = 0;

                    $this->factorNotes[$factor->id] = '';
                }
                $totalRateForPart += ($this->selectedValues[$factor->id] ?? 0);
                $factorsData[] = $factorData;
            }

            $this->partsWithFactors[] = [
                'part' => $part,
                'factors' => $factorsData,
                'totalRate' => $totalRateForPart, // Include the total rate in the array
            ];
            $totalRateForAllParts += $totalRateForPart;
        }



        return view('livewire.review-evaluation', [
            'employee' => $this->employee,
            'department' => $this->departmentName,
            'ratingScales' => $this->ratingScales,
            'partsWithFactors' => $this->partsWithFactors,
            'totalRateForAllParts' => $totalRateForAllParts, // Include the total rate for all parts
            'currentStep' => $this->currentStep,
            'clarifications' => $clarifications,

        ]);
    }
}
