<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Evaluation;
use App\Models\EvaluationPoint;
use App\Models\User;
use Livewire\Component;
use App\Models\RatingScale;
use App\Models\Factor;
use App\Models\FactorRatingScale;
use App\Models\Part;


use Illuminate\Support\Facades\Mail;
use App\Mail\EmailNotification;
use App\Models\Notification;
use App\Models\Recommendation;

class EvaluationForm extends Component
{
    public $currentStep = 1;
    public $employee;
    // public $employee_id;

    public $employeeId;
    public $employeeIdCompany;

    public $templateName;
    public $templateId;
    public $name;
    public $departmentName;
    public $position;
    public $date_hired;
    public $date_of_evaluation;
    public $ratingScales;
    public $partsWithFactors;
    public $selectedValues = []; // Initialize as an empty array
    public $factorNotes = [];
    public $selectedRatingScaleIds = [];

    public $selectedEquivalentPoints = [];
    public $recommendationNote = '';
    public $rateesComment = '';
    public $factorsPerPage = 6; // Number of factors per page
    public $currentPage = 1; // Make sure $currentPage is declared in your Livewire component
    public $isFormSubmitted = false; // Add this property

    public $evaluationID; // Add this property
    public $showRecommendationSection = false;

    public $currentSalary;
    public $recommendedPosition;
    public $level;
    public $recommendedSalary;
    public $remarks;
    public $effectivityTimestamp;



    public function mount($employee)
    {
        $this->selectedValues = session('selectedPoints', []);
        $this->factorNotes = session('factorNotes', []);
        $this->recommendationNote = session('recommendationNote', '');
        $this->rateesComment = session('rateesComment', '');
        $this->employeeId = $employee;
        $this->date_of_evaluation = now()->toDateString();
    }

    public function updateNote($factorId, $note)
    {
        $this->factorNotes[$factorId] = $note;

        // Store the updated data in the session.
        session(['factorNotes' => $this->factorNotes]);
    }


    public function updateComment($commentType)
    {
        // Determine which comment is being updated and update the session data accordingly.
        if ($commentType === 'recommendations') {
            session(['recommendationNote' => $this->recommendationNote]);
        } elseif ($commentType === 'ratee_comments') {
            session(['rateesComment' => $this->rateesComment]);
        }
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



    // Other properties and methods...

    public function displayRecommendationSection()
    {
        $this->showRecommendationSection = true;
    }
    public function updateSelectedValue($factorId, $value)
    {
        $this->selectedValues[$factorId] = $value;

        // Store the updated data in the session.
        session(['selectedPoints' => $this->selectedValues]);
    }
    public function goBack()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }

        // Re-initialize the component if going back to step 1
        if ($this->currentStep === 1) {
        }
    }



    public function submitStep1()
    {
        $parts = Part::where('evaluation_template_id', $this->templateId)->get();
        $count = $parts->count();
        if ($count < 4) {
            $this->currentStep = 2;
        } else if ($count == 1) {
            $this->currentStep = 0;
        }
    }

    public function submitStep2()
    {
        $parts = Part::where('evaluation_template_id', $this->templateId)->get();
        $count = $parts->count();
        if ($count == 3) {
            $this->currentStep = 3;
        } else if ($count == 2) {
            $this->currentStep = 0;
        }
    }


    public function submitStep3()
    {
        $parts = Part::where('evaluation_template_id', $this->templateId)->get();
        $count = $parts->count();
        if ($count == 3) {
            $this->currentStep = 0;
        }
    }



    public $loading = false;
    public function submitForm()
    {
        $this->loading = true; // Set loading to true when the form is being submitted

        if ($this->isFormSubmitted) {
            return;
        }
        // Retrieve data from the session
        $recommendationNote = session('recommendationNote', '');
        $rateesComment = session('rateesComment', '');
        $selectedPoints = session('selectedPoints', []);
        $factorNotes = session('factorNotes', []);
        $user = auth()->user();


        $this->dispatch('swal:modal', [
            'callback' => 'redirectAfterClose'
        ]);
        // Create a new evaluation record
        $evaluation =  Evaluation::create([
            'approver_id' => 0, // Change to the appropriate value
            'evaluator_id' => $user->employee->id, // Change to the appropriate value
            'employee_id' => $this->employeeId, // Change to the appropriate value
            'evaluation_template_id' => $this->templateId, // Use the template ID from your Livewire component
            'recommendation_note' => $recommendationNote,
            'ratees_comment' => $rateesComment,
            'status' => 1, // Set the default status
        ]);


        // Fetch data from the factor_rating_scales table
        $factorRatingScalesData = FactorRatingScale::where('evaluation_template_id', $this->templateId)->get();

        // Get the parts associated with the template
        $parts = Part::where('evaluation_template_id', $this->templateId)->get();


        foreach ($parts as $part) {
            // Get factors for the specific part and template
            $factors = Factor::where('evaluation_template_id', $this->templateId)
                ->where('part_id', $part->id)
                ->get();

            foreach ($factors as $factor) {
                $note = $factorNotes[$factor->id] ?? ''; // Set note to an empty string if it's null

                // Find the appropriate rating scale and factor rating scale based on factor's equivalent points
                $ratingScaleId = null;
                $factorRatingScaleId = null;
                $equivalentPoints = $selectedPoints[$factor->id] ?? null;

                foreach ($factorRatingScalesData as $frsData) {
                    if ($frsData['part_id'] == $part->id && $frsData['factor_id'] == $factor->id) {
                        // Check if the equivalent points match, and if they do, assign the rating scale and factor rating scale IDs
                        if ($equivalentPoints == $frsData['equivalent_points']) {
                            $ratingScaleId = $frsData['rating_scale_id'];
                            $factorRatingScaleId = $frsData['id'];

                            break; // Exit the loop once a match is found
                        }
                    }
                }

                // After retrieving values for $ratingScaleId and $factorRatingScaleId, add a check:
                if ($ratingScaleId !== null && $factorRatingScaleId !== null) {
                    // Create the evaluation point record with the found IDs
                    EvaluationPoint::create([
                        'evaluation_id' => $evaluation->id,
                        'evaluator_id' => $user->employee->id,
                        'employee_id' => $this->employeeId,
                        'evaluation_template_id' => $this->templateId,
                        'part_id' => $part->id,
                        'factor_id' => $factor->id,
                        'rating_scale_id' => $ratingScaleId,
                        'factor_rating_scale_id' => $factorRatingScaleId,
                        'points' => $equivalentPoints,
                        'note' => $note,
                    ]);
                } else {
                    // Handle the case when rating_scale_id or factor_rating_scale_id is null
                    // This might involve setting default values or skipping the insertion
                    // Or generating an error message for investigation
                }
            }
        }

        // Get all users with role_id 3
        $userss = User::where('role_id', 3)->get();

        // Prepare the data for the email
        $data = [
            'subject' => 'New evaluation ' . 'ID: ' . $evaluation->id,
            'body' => 'Evaluation for ' . $evaluation->employee->first_name . ' ' .   $evaluation->employee->last_name,

            // Add any additional data you want to pass to the email view
        ];

        // Send email to each user
        foreach ($userss as $user) {
            Mail::to($user->email)->send(new EmailNotification($data['body'], $data['subject']));
            // Store notification in the database
            Notification::create([
                'employee_id' => $user->employee_id,
                'notif_title' => $data['subject'],
                'notif_desc' => $data['body'],
            ]);
        }


        if (
            $this->currentSalary || $this->recommendedPosition || $this->level ||
            $this->recommendedSalary || $this->remarks || $this->effectivityTimestamp
        ) {
            // Create a new recommendation record
            Recommendation::create([
                'evaluation_id' => $evaluation->id,
                'employee_id' => $this->employeeId,
                'current_salary' => $this->currentSalary,
                'recommended_position' => $this->recommendedPosition,
                'level' => $this->level,
                'employment_status' => 'active',
                'recommended_salary' => $this->recommendedSalary,
                'percentage_increase' => (($this->recommendedSalary - $this->currentSalary) / $this->currentSalary) * 100,
                'remarks' => $this->remarks,
                'effectivity' => $this->effectivityTimestamp,
            ]);
        }

        $this->isFormSubmitted = true;
        session()->forget(['recommendationNote', 'rateesComment', 'selectedPoints', 'factorNotes']);
        // return redirect()->route('evaluations.index')->with('success', 'Form submitted successfully.');
        $this->loading = false; // Set loading back to false after the form submission is complete

    }


    public function submitReco()
    {

        $user = auth()->user();

        $this->dispatch('swal:modal2', [
            'callback' => 'redirectAfterClose'
        ]);

        $evaluation = $this->evaluationID;
        dd($evaluation);
    }



    public function render()
    {
        $employee = Employee::find($this->employeeId);
        $department = Department::find($employee->department_id);
        $this->departmentName = $department->name;
        $this->employeeIdCompany = $employee->employee_id;
        $this->name = $employee->first_name . ' ' . $employee->last_name;
        $this->position =  $employee->position;
        $this->date_hired = $employee->date_hired;

        $this->ratingScales = RatingScale::all();

        $parts = Part::where('evaluation_template_id', $this->templateId)->get();
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
                        'evaluation_template_id' => $this->templateId,
                        'part_id' => $part->id,
                        'factor_id' => $factor->id,
                    ])->get()->map(function ($scale) {
                        $ratingScale = RatingScale::find($scale->rating_scale_id);
                        $scale->acronym = $ratingScale->acronym;
                        return $scale;
                    }),
                ];


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


        $totalRates = $this->calculateTotalRate();

        return view('livewire.evaluation-form', [
            'employee' => $this->employee,
            'employeeId' => $this->employeeId,
            'department' => $this->departmentName,
            'ratingScales' => $this->ratingScales,
            'currentStep' => $this->currentStep,
            'totalRates' => $totalRates,
            'totalRateForAllParts' => $totalRateForAllParts, // Include the total rate for all parts



        ]);
    }
}
