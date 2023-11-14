<?php

namespace App\Livewire;

use App\Models\EvaluationTemplate;
use App\Models\Factor;
use App\Models\Part;
use App\Models\RatingScale;
use Livewire\Component;

class EvaluationTemplateEdit extends Component
{
    public $templateId;
    public $name;
    public $parts = [];

    public function mount($templateId)
    {
        $this->templateId = $templateId;

        // Fetch the template data and populate the form fields
        $template = EvaluationTemplate::findOrFail($templateId);
        $this->name = $template->name;

        foreach ($template->parts as $part) {
            $partData = [
                'name' => $part->name,
                'criteria_allocation' => $part->criteria_allocation,
                'factors' => [],
            ];

            foreach ($part->factors as $factor) {
                $factorData = [
                    'name' => $factor->name,
                    'description' => $factor->description,
                    'rating_scales' => $factor->factorRatingScales->pluck('equivalent_points', 'rating_scale_id')->toArray(),
                ];

                $partData['factors'][] = $factorData;
            }

            $this->parts[] = $partData;
        }
    }


    public function addPart()
    {
        $this->parts[] = [
            'name' => '',
            'criteria_allocation' => 0.0,
            'factors' => [],
        ];
    }

    public function addFactor($partIndex)
    {
        $this->parts[$partIndex]['factors'][] = [
            'name' => '',
            'description' => '',
            'rating_scales' => [],
        ];
    }

    public function removeFactor($partIndex, $factorIndex)
    {
        array_splice($this->parts[$partIndex]['factors'], $factorIndex, 1);
    }

    public function saveEvaluationTemplate()
    {
        // Update the template and related entities based on the form data
        $template = EvaluationTemplate::findOrFail($this->templateId);
        $template->update(['name' => $this->name]);

        foreach ($this->parts as $partIndex => $part) {
            $partModel = $template->parts->get($partIndex)->load('factors.factorRatingScales');

            if (!$partModel) {
                // Part doesn't exist, create a new one
                $partModel = Part::create([
                    'evaluation_template_id' => $template->id,
                    'name' => $part['name'],
                    'criteria_allocation' => $part['criteria_allocation'],
                ]);
            } else {
                // Part exists, update its attributes
                $partModel->update([
                    'name' => $part['name'],
                    'criteria_allocation' => $part['criteria_allocation'],
                ]);
            }

            foreach ($part['factors'] as $factorIndex => $factor) {
                $factorModel = $partModel->factors->get($factorIndex);

                if (!$factorModel) {
                    // Factor doesn't exist, create a new one
                    $factorModel = Factor::create([
                        'evaluation_template_id' => $template->id,
                        'part_id' => $partModel->id,
                        'name' => $factor['name'],
                        'description' => $factor['description'],
                        'alloted' => $this->getMaxEquivalentPoints($factor['rating_scales']),
                    ]);
                } else {
                    // Factor exists, update its attributes
                    $factorModel->update([
                        'name' => $factor['name'],
                        'description' => $factor['description'],
                        'alloted' => $this->getMaxEquivalentPoints($factor['rating_scales']),
                    ]);
                }

                // Update or create factor rating scales
                foreach ($factor['rating_scales'] as $scaleId => $equivalentPoints) {
                    $factorModel->factorRatingScales()->updateOrCreate(
                        [
                            'evaluation_template_id' => $template->id,
                            'part_id' => $partModel->id,
                            'factor_id' => $factorModel->id,
                            'rating_scale_id' => $scaleId,
                        ],
                        ['equivalent_points' => $equivalentPoints]
                    );
                }
            }
        }

        // Remove any parts that were deleted in the form
        $template->parts->filter(function ($part, $index) {
            return !collect($this->parts)->pluck('name')->contains($part->name);
        })->each->delete();

        session()->flash('message', 'Evaluation Template updated successfully!');
        return redirect()->route('templates.index'); // Redirect to the index page or wherever you want
    }

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
        return view('livewire.evaluation-template-edit', ['ratingScales' => $ratingScales]);
    }
}
