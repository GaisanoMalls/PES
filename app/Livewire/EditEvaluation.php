<?php

namespace App\Livewire;

use App\Models\Clarification;
use Livewire\Component;
use App\Models\Evaluation;
use App\Models\RatingScale;
use App\Models\EvaluationPoint;
use App\Models\Factor;
use App\Models\FactorRatingScale;
use App\Models\Part;
use App\Models\Recommendation;
use Carbon\Carbon;

class EditEvaluation extends Component
{




    public $currentStep = 1;

    public $evaluation;
    public $employee;
    public $departmentName;
    public $employeeIdCompany;
    public $name;
    public $position;
    public $date_hired;
    public $ratingScales;
    public $partsWithFactors;


    public $selectedValues = [];
    public $originalValues = [];

    public $selectedScale = [];
    public $originalScale = [];
    public $factorNotes = [];
    public $originalNotes = [];
    public $recommendationNote;
    public $rateesComment;
    public $recommendationNoteOld;
    public $rateesCommentOld;


    public $currentSalary;
    public $recommendedPosition;
    public $level;
    public $recommendedSalary;
    public $remarks;
    public $effectivityTimestamp;

    public $showClarificationSection = false;
    public $clarificationDescription;

    public function mount(Evaluation $evaluation)
    {
        $this->evaluation = $evaluation->load('evaluationTemplate');
        $this->recommendationNote = $evaluation->recommendation_note;
        $this->rateesComment = $evaluation->ratees_comment;
        $this->loadEmployeeData();
        $this->loadRatingScales();
    }

    public function displayClarificationSection()
    {
        $this->showClarificationSection = true;
    }

    private function loadEmployeeData()
    {
        $this->employee = $this->evaluation->employee;
        $this->departmentName = $this->employee->department->name;
        $this->employeeIdCompany = $this->employee->employee_id;
        $this->name = $this->employee->first_name . ' ' . $this->employee->last_name;
        $this->position = $this->employee->position;
        $this->date_hired = $this->employee->date_hired;
    }


    private function loadRatingScales()
    {
        $this->ratingScales = RatingScale::all();
    }
    public function updateSelectedValue($factorId, $value)
    {
        // Update only the selectedValues
        if ($this->selectedValues[$factorId] !== $value) {
            $this->selectedValues[$factorId] = $value;

            // Additional logic for storing the updated data if needed
        }
    }

    public function updatedSelectedValues($value, $factorId)
    {
        // Trigger Livewire update when selectedValues change
        $this->selectedValues = array_merge($this->selectedValues, [$factorId => $value]);
    }

    public function updateSelectedScale($factorId, $value)
    {
        // Update only the selectedValues
        if ($this->selectedScale[$factorId] !== $value) {
            $this->selectedScale[$factorId] = $value;

            // Additional logic for storing the updated data if needed
        }
    }

    public function updatedSelectedScale($value, $factorId)
    {
        // Trigger Livewire update when selectedValues change
        $this->selectedScale = array_merge($this->selectedScale, [$factorId => $value]);
    }

    public function updateEvaluation()
    {
        foreach ($this->partsWithFactors as $partWithFactors) {
            foreach ($partWithFactors['factors'] as $factorData) {
                $factorId = $factorData['factor']->id;

                // Use the original value if the selected value is 0
                $selectedValue = $this->selectedValues[$factorId] !== 0
                    ? $this->selectedValues[$factorId]
                    : $this->originalValues[$factorId];


                // Fetch the note from the textarea
                $note = !empty($this->factorNotes[$factorId]) ? $this->factorNotes[$factorId] : $this->originalNotes[$factorId];

                // Find the appropriate rating scale and factor rating scale based on factor's equivalent points
                $ratingScaleId = null;
                $factorRatingScaleId = null;
                $equivalentPoints = $selectedValue;

                // Fetch data from the factor_rating_scales table
                $factorRatingScalesData = FactorRatingScale::where('evaluation_template_id', $this->evaluation->evaluation_template_id)
                    ->where('part_id', $partWithFactors['part']->id)
                    ->where('factor_id', $factorId)
                    ->get();

                foreach ($factorRatingScalesData as $frsData) {
                    if ($equivalentPoints == $frsData['equivalent_points']) {
                        $ratingScaleId = $frsData['rating_scale_id'];
                        $factorRatingScaleId = $frsData['id'];
                        break;
                    }
                }

                // Update or create EvaluationPoint
                $evaluationPoint = EvaluationPoint::updateOrCreate(
                    [
                        'evaluation_id' => $this->evaluation->id,
                        'part_id' => $partWithFactors['part']->id,
                        'factor_id' => $factorId,
                    ],
                    [
                        'points' => $selectedValue,
                        'rating_scale_id' => $ratingScaleId,
                        'factor_rating_scale_id' => $factorRatingScaleId,
                        'note' => $note, // Pass the fetched note
                    ]
                );
            }
        }
        $this->evaluation->update([
            'recommendation_note' => $this->recommendationNote,
            'ratees_comment' => $this->rateesComment,
        ]);



        // Update recommendation fields



        // Set effectivity based on the provided timestamp
        $effectivity = $this->effectivityTimestamp ? now()->parse($this->effectivityTimestamp) : null;

        // Check if a recommendation exists
        if ($this->evaluation->recommendation) {
            // Update existing recommendation
            $this->evaluation->recommendation->update([
                'current_salary' => $this->currentSalary ?? $this->evaluation->recommendation->current_salary,
                'recommended_position' => $this->recommendedPosition ?? $this->evaluation->recommendation->recommended_position,
                'level' => $this->level ?? $this->evaluation->recommendation->level,
                'recommended_salary' => $this->recommendedSalary ?? $this->evaluation->recommendation->recommended_salary,
                'remarks' => $this->remarks ?? $this->evaluation->recommendation->remarks,
                'effectivity' => $effectivity ?? $this->evaluation->recommendation->effectivity,
            ]);
        } elseif (
            $this->currentSalary !== null &&
            $this->recommendedPosition !== null &&
            $this->level !== null &&
            $this->recommendedSalary !== null &&
            $this->effectivityTimestamp !== null
        ) {
            // Create a new recommendation entry only if required fields are not null
            Recommendation::create([
                'evaluation_id' => $this->evaluation->id,
                'employee_id' => $this->evaluation->employee_id,
                'current_salary' => $this->currentSalary,
                'recommended_position' => $this->recommendedPosition,
                'level' => $this->level,
                'employment_status' => 'Active',
                'recommended_salary' => $this->recommendedSalary,
                'percentage_increase' => (($this->recommendedSalary - $this->currentSalary) / $this->currentSalary) * 100,
                'remarks' => $this->remarks,
                'effectivity' => $effectivity,
            ]);
        }

        // You may want to update the $this->evaluation variable with the latest data
        $this->evaluation = $this->evaluation->fresh();


        // After updating, you can redirect or perform any other actions
        session()->flash('success', 'Evaluation updated successfully.');
        return redirect()->to(route('evaluations.index'));
    }



    public function render()
    {
        $this->ratingScales = RatingScale::all();
        $clarifications = Clarification::where('evaluation_id', $this->evaluation->id)->get();

        $parts = Part::where('evaluation_template_id', $this->evaluation->evaluation_template_id)->get();
        $this->partsWithFactors = [];
        $totalRateForAllParts = 0;

        foreach ($parts as $part) {
            $factors = Factor::where('part_id', $part->id)->get();
            $factorsData = [];
            $totalRateForPart = 0;

            foreach ($factors as $factor) {
                $factorData = [
                    'factor' => $factor,
                    'rating_scales' => FactorRatingScale::where([
                        'evaluation_template_id' => $this->evaluation->evaluation_template_id,
                        'part_id' => $part->id,
                        'factor_id' => $factor->id,
                    ])->get(),
                ];
                // Initialize originalValues only if not set before
                if (!isset($this->originalValues[$factor->id])) {
                    $this->originalValues[$factor->id] = 0;
                }

                // Initialize selectedValues only if not set before
                if (!isset($this->selectedValues[$factor->id])) {
                    $this->selectedValues[$factor->id] = 0;
                }

                $evaluationPoint = EvaluationPoint::where([
                    'evaluation_id' => $this->evaluation->id,
                    'part_id' => $part->id,
                    'factor_id' => $factor->id,
                ])->first();

                if ($evaluationPoint) {
                    // Update only the originalValues
                    $this->originalValues[$factor->id] = $evaluationPoint->points;
                    $this->originalScale[$factor->id] = $evaluationPoint->rating_scale_id;
                    // dd($this->originalScale[$factor->id]);
                    $this->originalNotes[$factor->id] = $evaluationPoint->note;
                } else {
                    // If no evaluation point is found, set the default value
                    $this->originalValues[$factor->id] = 0;
                    $this->originalScale[$factor->id] = 0;
                    $this->originalNotes[$factor->id] = '';
                }

                // Use the selected value if it is not 0; otherwise, use the original value
                $selectedValue = $this->selectedValues[$factor->id] !== 0
                    ? $this->selectedValues[$factor->id]
                    : $this->originalValues[$factor->id];


                $totalRateForPart += $selectedValue;

                $factorsData[] = $factorData;
            }

            $this->partsWithFactors[] = [
                'part' => $part,
                'factors' => $factorsData,
                'totalRate' => $totalRateForPart,
            ];
            $totalRateForAllParts += $totalRateForPart;
        }

        return view('livewire.edit-evaluation', [
            'employee' => $this->employee,
            'department' => $this->departmentName,
            'ratingScales' => $this->ratingScales,
            'partsWithFactors' => $this->partsWithFactors,
            'totalRateForAllParts' => $totalRateForAllParts,
            'clarifications' => $clarifications,

            'currentStep' => $this->currentStep,
        ]);
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
}
