<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Evaluation;
use App\Models\EvaluationPoint;
use App\Models\NotificationEvaluation;
use App\Models\User;
use Livewire\Component;
use App\Models\RatingScale;
use App\Models\Factor;
use App\Models\FactorRatingScale;
use App\Models\Part;


use Illuminate\Support\Facades\Mail;
use App\Mail\EmailNotification;
use App\Models\DepartmentConfiguration;
use App\Models\EvaluationApprovers;
use App\Models\Recommendation;

class EvaluationForm extends Component
{


    public $currentStep = 1;
    public $currentPart = 1; // Add this line
    public $lastStep = 0;

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
    public $isFormSubmitted = false; // Add this property

    public $evaluationID; // Add this property
    public $showRecommendationSection = false;

    public $currentSalary;
    public $recommendedPosition;
    public $level;
    public $recommendedSalary;
    public $remarks;
    public $effectivityTimestamp;
    public $percentageIncrease;



    //load data from session
    public function mount($employee)
    {
        $this->selectedValues = session('selectedPoints', []);
        $this->factorNotes = session('factorNotes', []);
        $this->recommendationNote = session('recommendationNote', '');
        $this->rateesComment = session('rateesComment', '');
        $this->employeeId = $employee;
        $this->date_of_evaluation = now()->toDateString();
        $this->currentPart = 1;
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

    //Calculate total rates of each part
    public function calculateTotalRate()
    {
        $totalRates = [];

        // Loop through each part and calculate the total rate for each part
        foreach ($this->partsWithFactors as $partWithFactors) {
            $partTotal = 0.0; // Change the data type to float

            // Loop through factors within each part and calculate their total rate
            foreach ($partWithFactors['factors'] as $factorData) {
                $factorId = $factorData['factor']->id;
                $selectedValue = $this->selectedValues[$factorId] ?? 0;

                // Ensure $selectedValue is always an integer
                if (is_array($selectedValue)) {
                    $partTotal += array_sum($selectedValue);
                } else {
                    $partTotal += (float) $selectedValue; // Convert to float if not already
                }
            }

            // Store the total rate for this part
            $totalRates[$partWithFactors['part']->id] = $partTotal;
        }

        return $totalRates;
    }



    //Add Recommendation
    public function displayRecommendationSection()
    {
        $this->showRecommendationSection = true;
    }

    //Wire click to display the selected value on the box
    public function updateSelectedValue($factorId, $value)
    {
        $this->selectedValues[$factorId] = $value;

        // Store the updated data in the session.
        session(['selectedPoints' => $this->selectedValues]);
    }



    //GO BACK FUNCTION
    public function goBackToStep($step)
    {
        if ($step >= 1 && $step < $this->currentStep) {
            $this->currentStep = $step;
        }
    }
    public function goBack()
    {
        // Move to the previous part logic
        if ($this->currentPart > 1) {
            $this->currentPart--;
        }
    }


    public function submitStep1($nextStep)
    {
        $totalNumberOfParts = $this->getTotalNumberOfPartsForTemplate($this->templateId);

        if ($nextStep <= $totalNumberOfParts) {
            $this->currentPart = $nextStep;
            $this->lastStep = $this->currentPart;
        } else if ($this->currentPart == $totalNumberOfParts) {
            $this->currentStep = 'LAST';
            $this->lastStep = 1;
        }
    }

    private function getTotalNumberOfPartsForTemplate($templateId)
    {
        // Use your database query logic here to get the count
        // This is just an example, you should replace it with your actual logic
        return Part::where('evaluation_template_id', $templateId)->count();
    }

    public function calculatePercentageIncrease()
    {
        if ($this->currentSalary > 0 && $this->recommendedSalary > 0) {
            $percentageIncrease = (($this->recommendedSalary - $this->currentSalary) / $this->currentSalary) * 100;
            $this->percentageIncrease = round($percentageIncrease, 2);
        } else {
            $this->percentageIncrease = null;
        }
    }



    public $loading = false; // spinner
    public function submitForm()
    {
        $this->loading = true; // Set loading to true when the form is being submitted

        if ($this->isFormSubmitted) {
            return;
        }

        // retrieve data from the session
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
            'approver_count' => 0,
            'evaluator_id' => $user->employee->id,
            'employee_id' => $this->employeeId,
            'evaluation_template_id' => $this->templateId,
            'recommendation_note' => $recommendationNote,
            'ratees_comment' => $rateesComment,
            'status' => 1, //default status | pending
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
                    // handle when rating_scale_id or factor_rating_scale_id is null

                }
            }
        }




        // EMAIL NOTIF AND SYSTEM NOTIF
        // Get the department configuration based on department_id and branch_id
        $departmentConfiguration = DepartmentConfiguration::where('department_id', $evaluation->employee->department_id)
            ->where('branch_id', $evaluation->employee->branch_id)
            ->first();

        if ($departmentConfiguration) {
            // Access the evaluation_approvers table
            $evaluationApprovers = EvaluationApprovers::where('department_configuration_id', $departmentConfiguration->id)
                ->get();

            // Get the employee_id from evaluation_approvers and store it on notifiable_id
            foreach ($evaluationApprovers as $approver) {
                $notifiableId = $approver->employee_id;
                $personId = $approver->approver_id;
                $userApprover = User::where('employee_id', $approver->employee_id)->first();
                $url = env('APP_URL');
                // Prepare the data for the email
                $data = [
                    'subject' => 'New Performance Evaluation  ' . $evaluation->employee->first_name . ' ' . $evaluation->employee->last_name . ' (ID:' . $evaluation->id . ')',
                    'body' => 'This email is to notify you that ' . $evaluation->employee->first_name . ' ' . $evaluation->employee->last_name . ' is now available for your review.',
                    'link' => $url . 'evaluations/review/' . $evaluation->id,
                ];
                // Send email to each approver
                Mail::to($userApprover->email)->send(new EmailNotification($data['body'], $data['subject'], $data['link']));
                // Store notification in the database
                NotificationEvaluation::create([
                    'type' => 'evaluation',
                    'notifiable_id' => $notifiableId,
                    'person_id' => $evaluation->id,
                    'notif_title' => $data['subject'],
                    'notif_desc' => $data['body'],
                ]);
            }
        }


        // Notify employee
        $data = [
            'subject' => 'New Performance Evaluation for ' . $evaluation->employee->first_name . ' ' . $evaluation->employee->last_name . ' (ID: ' . $evaluation->id . ')',
            'body' => 'This email is to notify you that your performance evaluation is now available for review.',
        ];

        NotificationEvaluation::create([
            'type' => 'evaluation',
            'notifiable_id' => $this->employeeId,
            'person_id' => $evaluation->id,
            'notif_title' => $data['subject'],
            'notif_desc' => $data['body'],
        ]);



        //ADD RECOMMENDATION
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
                'percentage_increase' => round((($this->recommendedSalary - $this->currentSalary) / $this->currentSalary) * 100, 2),
                'remarks' => $this->remarks,
                'effectivity' => $this->effectivityTimestamp,
            ]);
        }


        //prevent duplicates
        $this->isFormSubmitted = true;
        //spinner
        $this->loading = false;

        //clear session
        session()->forget(['recommendationNote', 'rateesComment', 'selectedPoints', 'factorNotes']);
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
        $totalRateForAllParts = 0;
        $totalNumberOfParts = 0;
        foreach ($parts as $part) {
            $totalNumberOfParts++;

            $factors = Factor::where('part_id', $part->id)->get();
            $factorsData = [];
            $totalRateForPart = 0;
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

                $totalRateForPart += (float) ($this->selectedValues[$factor->id] ?? 0);
                $factorsData[] = $factorData;
            }

            $this->partsWithFactors[] = [
                'part' => $part,
                'factors' => $factorsData,
                'totalRate' => $totalRateForPart,
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
            'totalRateForAllParts' => $totalRateForAllParts,
            'totalNumberOfParts' => $totalNumberOfParts, // Pass the total number of parts to the view

        ]);
    }
}
