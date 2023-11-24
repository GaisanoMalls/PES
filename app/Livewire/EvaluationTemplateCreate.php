<?php

namespace App\Livewire;

use App\Models\EvaluationTemplate;
use App\Models\Factor;
use App\Models\FactorRatingScale;
use App\Models\Part;
use App\Models\RatingScale;
use Livewire\Component;

class EvaluationTemplateCreate extends Component
{


    public $name;
    public $parts = [];
    // Add this method to your Livewire component

    public function addPart()
    {
        $this->parts[] = [
            'name' => '',
            'criteria_allocation' => 0.0,
            'factors' => []
        ];
    }
    public function addFactor($partIndex)
    {
        $this->parts[$partIndex]['factors'][] = [
            'name' => '',
            'description' => '',
            'rating_scales' => []
        ];
    }


    public function removeFactor($partIndex, $factorIndex)
    {
        array_splice($this->parts[$partIndex]['factors'], $factorIndex, 1);
    }
    public function addRatingScales($partIndex, $factorIndex)
    {
        $this->parts[$partIndex]['factors'][$factorIndex]['rating_scales'][] = [
            'name' => '', // Set necessary rating scale properties
            'description' => '', // Set necessary rating scale properties
            'equivalent_points' => 0.0
        ];
    }
    public function createEvaluationTemplate()
    {

        $this->dispatch('swal:success', [
            'callback' => 'redirectAfterClose'
        ]);
        $evaluationTemplate = EvaluationTemplate::create([
            'name' => $this->name
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
