<?php

namespace App\Livewire;

use App\Models\EvaluationTemplate;
use App\Models\Factor;
use App\Models\FactorRatingScale;
use App\Models\Part;
use App\Models\RatingScale;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Illuminate\Validation\Rule;

class EvaluationTemplateCreate extends Component
{


    public $name;
    public $parts = [];
    public $newFactorName = '';
    public $newFactorDescription = '';
    public $newFactorRatingScales = [];
    public $currentPartIndex;
    public $currentFactorIndex;

    protected $rules = [
        'newFactorName' => 'required',
        'newFactorDescription' => 'required',
        'newFactorRatingScales' => 'required|array|filled:numeric|between:0,100|size:5|descending_order',
        'newFactorRatingScales.*' => 'numeric|between:0,100', // Assuming a numeric rating scale between 0 and 100
    ];
    public $isValid = false; // Add this line
    public function validateInputs()
    {
        $this->validate();
        $this->isValid = true;
    }
    public function addFactor($partIndex)
    {

        // Check if the required fields are not empty
        if (!empty($this->newFactorName) || !empty($this->newFactorDescription) || !empty($this->newFactorRatingScales)) {
            // Make sure $this->newFactorRatingScales is an array
            if (!is_array($this->newFactorRatingScales)) {
                $this->newFactorRatingScales = [];
            }
            arsort($this->newFactorRatingScales);

            $this->validate();

            $newFactor = [
                'name' => $this->newFactorName,
                'description' => $this->newFactorDescription,
                'rating_scales' => $this->newFactorRatingScales
            ];

            // Add the new factor to the specified part
            $this->parts[$partIndex]['factors'][] = $newFactor;

            // Reset the input fields
            $this->reset(['newFactorName', 'newFactorDescription', 'newFactorRatingScales']);
            $this->isValid = true;
        } else {
            // Set $isValid to false if any required field is empty
            $this->isValid = false;
        }
    }

    public function addPart()
    {
        $this->parts[] = [
            'name' => '',
            'criteria_allocation' => 0.0,
            'factors' => []
        ];
    }

    public function removeFactor($partIndex, $factorIndex)
    {
        array_splice($this->parts[$partIndex]['factors'], $factorIndex, 1);
    }

    public function removePart($partIndex)
    {
        $partModel = isset($this->template->parts[$partIndex]) ? $this->template->parts[$partIndex] : null;

        // Delete the part and its factors only if it exists
        if ($partModel) {
            // Delete factors
            foreach ($partModel->factors as $factor) {
                $factor->delete();
            }

            // Delete the part
            $partModel->delete();
        }

        array_splice($this->parts, $partIndex, 1);
    }
    public function createEvaluationTemplate()
    {
        // Calculate the total criteria allocation
        $totalAllocation = array_sum(array_column($this->parts, 'criteria_allocation'));

        // Validate total criteria allocation
        if ($totalAllocation !== 100) {
            $this->addError('parts.criteria_allocation', 'Total criteria allocation must be 100.');
            return;
        }


        $this->dispatch('swal:success', [
            'callback' => 'redirectAfterClose'
        ]);
        $evaluationTemplate = EvaluationTemplate::create([
            'name' => $this->name,
            'status' => 2,
        ]);

        foreach ($this->parts as $part) {
            $newPart = Part::create([
                'evaluation_template_id' => $evaluationTemplate->id,
                'name' => $part['name'],
                'criteria_allocation' => $part['criteria_allocation']
            ]);

            foreach ($part['factors'] as $factor) {
                $newFactor = Factor::create([
                    'evaluation_template_id' => $evaluationTemplate->id,
                    'part_id' => $newPart->id,
                    'name' => $factor['name'],
                    'description' => $factor['description'],
                    'alloted' => $this->getMaxEquivalentPoints($factor['rating_scales']) // Function to get max equivalent points
                ]);

                foreach ($factor['rating_scales'] as $scaleId => $equivalentPoints) {
                    FactorRatingScale::create([
                        'evaluation_template_id' => $evaluationTemplate->id,
                        'part_id' => $newPart->id,
                        'factor_id' => $newFactor->id,
                        'rating_scale_id' => $scaleId,
                        'equivalent_points' => $equivalentPoints
                    ]);
                }
            }
        }
        // Reset form data or add success message
        $this->reset(['name', 'parts']);
    }

    // Function to find the maximum equivalent points
    private function getMaxEquivalentPoints($ratingScales)
    {
        $maxPoints = 0;

        foreach ($ratingScales as $scale) {
            if ($scale > $maxPoints) {
                $maxPoints = $scale;
            }
        }

        return $maxPoints;
    }

    public function render()
    {
        $ratingScales = RatingScale::all();

        return view('livewire.evaluation-template-create', ['ratingScales' => $ratingScales]);
    }
}
