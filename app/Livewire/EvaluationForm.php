<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Evaluation;
use App\Models\EvaluationPoint;
use Livewire\Component;
use App\Models\RatingScale;
use App\Models\Factor;
use App\Models\FactorRatingScale;
use App\Models\Part;


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

    public function mount($employee)
    {
        $this->selectedValues = session('selectedPoints', []);
        $this->factorNotes = session('factorNotes', []);
        $this->recommendationNote = session('recommendationNote', '');
        $this->rateesComment = session('rateesComment', '');
        $this->employeeId = $employee;
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


    public function updateSelectedValue($factorId, $value)
    {
        $this->selectedValues[$factorId] = $value;

        // Store the updated data in the session.
        session(['selectedPoints' => $this->selectedValues]);
    }


    public function submitStep1()
    {
        // Retrieve data from the session
        $recommendationNote = session('recommendationNote', '');
        $rateesComment = session('rateesComment', '');
        $selectedPoints = session('selectedPoints', []);
        $factorNotes = session('factorNotes', []);
        $user = auth()->user();


        // Create a new evaluation record
        $evaluation = Evaluation::create([
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
                        'evaluator_id' => 1002,
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
        session()->forget(['recommendationNote', 'rateesComment', 'selectedPoints', 'factorNotes']);
        return redirect()->route('evaluations.index');
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

        foreach ($parts as $part) {
            $factors = Factor::where('part_id', $part->id)->get();
            $factorsData = [];

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

                $factorsData[] = $factorData;
            }

            $this->partsWithFactors[] = [
                'part' => $part,
                'factors' => $factorsData,
            ];
        }


        $totalRates = $this->calculateTotalRate();

        return view('livewire.evaluation-form', [
            'employee' => $this->employee,
            'employeeId' => $this->employeeId,
            'department' => $this->departmentName,
            'ratingScales' => $this->ratingScales,
            'currentStep' => $this->currentStep,
            'totalRates' => $totalRates,

        ]);
    }
}
