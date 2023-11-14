<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Employee;
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
    public $employeeId;
    public $employee;
    public $departmentName;
    public $employeeIdCompany;
    public $name;
    public $position;
    public $date_hired;
    public $ratingScales;
    public $partsWithFactors;


    public $totalRates = [];
    public $ratingScaleNames = [];
    public $selectedValues = [];
    public $factorNotes = [];
    public $selectedScale = [];

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


        $this->ratingScales = RatingScale::all();

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

        ]);
    }
}
