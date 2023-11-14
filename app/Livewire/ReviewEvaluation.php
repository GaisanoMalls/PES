<?php

namespace App\Livewire;

use App\Models\Evaluation;
use App\Models\EvaluationPoint;
use App\Models\Factor;
use App\Models\FactorRatingScale;
use App\Models\Part;
use App\Models\RatingScale;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class ReviewEvaluation extends Component
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
    public $partsWithFactors = [];
    public $selectedValues = [];
    public $factorNotes = [];
    public $totalRates = [];
    public $ratingScaleNames = [];


    public function mount(Evaluation $evaluation)
    {
        $this->evaluation = $evaluation->load('evaluationTemplate');
        $this->loadEmployeeData();
        $this->loadRatingScales();
        $this->loadPartsWithFactors();
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

    public function calculateTotalRates()
    {
        $totalRates = [];

        foreach ($this->partsWithFactors as $partWithFactors) {
            $totalRate = 0;

            foreach ($partWithFactors['factors'] as $factor) {
                $factorId = $factor->id;
                $totalRate += $this->selectedValues[$factorId];
            }

            $totalRates[$partWithFactors['part']->id] = $totalRate;
        }

        // Calculate the combined total rate
        $combinedTotalRate = array_sum($totalRates);

        return [
            'totalRates' => $totalRates,
            'combinedTotalRate' => $combinedTotalRate,
        ];
    }

    public function loadPartsWithFactors()
    {
        // Fetch parts associated with the template ID
        $parts = Part::where('evaluation_template_id', $this->evaluation->evaluation_template_id)->get();

        $ratingScaleNames = [];

        foreach ($parts as $part) {
            $factors = Factor::where('part_id', $part->id)->get();

            $factorCounter = 1; // Initialize factor counter to 1 for each part

            $totalRate = 0; // Initialize total rate for the current part
            $ratingScaleNamesForPart = []; // Initialize array to store rating scale names

            foreach ($factors as $factor) {
                // Load factor rating scales
                $ratingScales = FactorRatingScale::where([
                    'evaluation_template_id' => $this->evaluation->evaluation_template_id,
                    'part_id' => $part->id,
                    'factor_id' => $factorCounter,
                ])->get();
                $factor->rating_scales = []; // Initialize as an empty array

                // Check if rating scales exist before adding them
                $factor->rating_scales = $ratingScales->isNotEmpty() ? $ratingScales : []; // Set as an array if not empty, otherwise as an empty array
                if ($factor->rating_scales) { // Check if not null or empty before the foreach loop

                    foreach ($factor->rating_scales as $ratingScale) {
                        $ratingScale->acronym = RatingScale::find($ratingScale->rating_scale_id)->acronym;
                        $ratingScaleNamesForPart[] = $ratingScale->name; // Store rating scale name
                    }
                }

                $evaluationPoint = EvaluationPoint::where([
                    'evaluation_id' => $this->evaluation->id,
                    'part_id' => $part->id,
                    'factor_id' => $factorCounter,
                ])->first();

                if ($evaluationPoint) {
                    $this->selectedValues[$factor->id] = $evaluationPoint->points;
                    $this->factorNotes[$factor->id] = $evaluationPoint->note;
                    $totalRate += $evaluationPoint->points; // Add the points to the total rate
                } else {
                    $this->selectedValues[$factor->id] = 0;
                    $this->factorNotes[$factor->id] = '';
                }

                $factorCounter++; // Increment the factor counter
            }

            // Assign the total rate to the current part
            $part->totalRate = $totalRate;

            $this->partsWithFactors[] = [
                'part' => $part,
                'factors' => $factors,
            ];
            $this->totalRates[$part->id] = $totalRate;
            // Store rating scale names in the main array
            $this->ratingScaleNames[$part->id] = $ratingScaleNamesForPart;
        }
    }



    public function approveEvaluation()
    {
        $this->evaluation->status = 2;
        $this->evaluation->save();
        return Redirect::to(route('evaluations.index'));
    }
    public function disapproveEvaluation()
    {
        $this->evaluation->status = 3;
        $this->evaluation->save();
        return Redirect::to(route('evaluations.index'));
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
        $totals = $this->calculateTotalRates();

        return view('livewire.review-evaluation', [
            'employee' => $this->employee,
            'department' => $this->departmentName,
            'ratingScales' => $this->ratingScales,
            'partsWithFactors' => $this->partsWithFactors,
            'currentStep' => $this->currentStep,
            'totalRates' => $totals['totalRates'],
            'combinedTotalRate' => $totals['combinedTotalRate'],
        ]);
    }
}
