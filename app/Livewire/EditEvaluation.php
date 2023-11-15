<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Evaluation;
use App\Models\RatingScale;
use App\Models\EvaluationPoint;
use App\Models\Factor;
use App\Models\FactorRatingScale;
use App\Models\Part;

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
    public function mount(Evaluation $evaluation)
    {
        $this->evaluation = $evaluation->load('evaluationTemplate');
        $this->recommendationNote = $evaluation->recommendation_note;
        $this->rateesComment = $evaluation->ratees_comment;
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
        // Additional logic after updating EvaluationPoints if needed

        // After updating, you can redirect or perform any other actions
        session()->flash('success', 'Evaluation updated successfully.');
        return redirect()->to(route('evaluations.index'));
    }



    public function render()
    {
        $this->ratingScales = RatingScale::all();
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

            'currentStep' => $this->currentStep,
        ]);
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
