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
use Illuminate\Support\Facades\Session;

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
    public $selectedValues = [];
    public $factorNotes = [];
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

    public function updateSelectedValue($factorId, $value)
    {
        $this->selectedValues[$factorId] = $value;

        // Store the updated data in the session.
        session(['selectedPoints' => $this->selectedValues]);
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
        $totalRatePart1 = 0;
        $totalRatePart2 = 0;
        $totalRatePart3 = 0;
        $totalRateCombined = 0;
        // Loop through selectedValues and calculate the total rate for each part separately.
        foreach ($this->selectedValues as $factorId => $selectedValue) {
            $factor = Factor::find($factorId); // Assuming you have a Factor model.
            if ($factor) {
                if ($factor->part_id === 1) {
                    $totalRatePart1 += $selectedValue;
                } elseif ($factor->part_id === 2) {
                    $totalRatePart2 += $selectedValue;
                } elseif ($factor->part_id === 3) {
                    $totalRatePart3 += $selectedValue;
                }
            }
        }

        // Calculate the combined total rate for all three parts.
        $totalRateCombined = $totalRatePart1 + $totalRatePart2 + $totalRatePart3;

        return [
            'part1' => $totalRatePart1,
            'part2' => $totalRatePart2,
            'part3' => $totalRatePart3,
            'combined' => $totalRateCombined, // Add the combined total rate.
        ];
    }




    public function submitStep1()
    {
        // Store selectedPoints in session
        //dd(session('selectedPoints'));

        $this->currentStep = 2;
    }
    public function submitStep2()
    {
        // Store selectedPoints in session
        // dd(session('selectedPoints'));


        $this->currentStep = 3;
    }
    public function submitStep3()
    {

        $this->currentStep = 4;
    }



    public function submitStep4()
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

        // Loop through the parts and associated factors to create evaluation point records
        foreach ($parts as $part) {
            $factors = Factor::where('part_id', $part->id)->get();
            $factorId = 1; // Reset factor ID for each part

            foreach ($factors as $factor) {
                $note = $factorNotes[$factor->id] ?? ''; // Set note to an empty string if it's null

                // Find the appropriate rating scale and factor rating scale based on factor's equivalent points
                $ratingScaleId = null;
                $factorRatingScaleId = null;
                $equivalentPoints = $selectedPoints[$factor->id]; // Get points based on factor ID

                foreach ($factorRatingScalesData as $frsData) {
                    if ($frsData['part_id'] == $part->id && $frsData['factor_id'] == $factorId) {
                        // Check if the equivalent points match, and if they do, assign the rating scale and factor rating scale IDs
                        if ($equivalentPoints == $frsData['equivalent_points']) {
                            $ratingScaleId = $frsData['rating_scale_id'];
                            $factorRatingScaleId = $frsData['id'];
                            break; // Exit the loop once a match is found
                        }
                    }
                }

                // Create the evaluation point record with the found IDs
                if ($ratingScaleId !== null && $factorRatingScaleId !== null) {
                    EvaluationPoint::create([
                        'evaluation_id' => $evaluation->id,
                        'evaluator_id' => 1002, // Change to the appropriate value
                        'employee_id' => $this->employeeId, // Change to the appropriate value
                        'evaluation_template_id' => $this->templateId,
                        'part_id' => $part->id, // Part ID based on the current part
                        'factor_id' => $factorId, // Factor ID starts from 1 for each part
                        'rating_scale_id' => $ratingScaleId, // Set the appropriate rating scale ID
                        'factor_rating_scale_id' => $factorRatingScaleId, // Set the appropriate factor rating scale ID
                        'points' => $equivalentPoints, // Get points based on factor ID
                        'note' => $note, // Set the note with a default value if it's null
                    ]);
                }

                $factorId++; // Increment factor ID for the next factor
            }

            // Reset factor ID for the next part
            $factorId = 1;
        }
        session()->forget(['recommendationNote', 'rateesComment', 'selectedPoints', 'factorNotes']);
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

    public function render()
    {
        // Load employee data (modify this to load your employee data)
        // $this->employee = Employee::find($this->employee_id);
        $employee = Employee::find($this->employeeId);

        $department = Department::find($employee->department_id);
        $this->departmentName = $department->name;
        $this->employeeIdCompany = $employee->employee_id;
        $this->name = $employee->first_name . ' ' . $employee->last_name;
        $this->position =  $employee->position;
        $this->date_hired = $employee->date_hired;
        // Load rating scales
        $this->ratingScales = RatingScale::all();
        // dd($department);
        // Fetch parts associated with the template ID
        $parts = Part::where('evaluation_template_id', $this->templateId)->get();
        $this->partsWithFactors = [];

        foreach ($parts as $part) {
            $factors = Factor::where('part_id', $part->id)->get();
            $factorCounter = 1;

            foreach ($factors as $factor) {
                $factor->rating_scales = FactorRatingScale::where([
                    'evaluation_template_id' => $this->templateId,
                    'part_id' => $part->id,
                    'factor_id' => $factorCounter,
                ])->get();
                foreach ($factor->rating_scales as $ratingScale) {
                    $ratingScale->acronym = RatingScale::find($ratingScale->rating_scale_id)->acronym;
                }
                $factorCounter++;
            }

            $this->partsWithFactors[] = [
                'part' => $part,
                'factors' => $factors,
            ];
        }
        $totalRates = $this->calculateTotalRate();


        return view('livewire.evaluation-form', [
            'employee' => $this->employee,
            'employeeId' => $this->employeeId,
            'department' => $this->departmentName,
            'ratingScales' => $this->ratingScales,
            'partsWithFactors' => $this->partsWithFactors,
            'currentStep' => $this->currentStep,
            'totalRatePart1' => $totalRates['part1'],
            'totalRatePart2' => $totalRates['part2'],
            'totalRatePart3' => $totalRates['part3'],
            'totalRateCombine' => $totalRates['combined']
        ]);
    }
}
