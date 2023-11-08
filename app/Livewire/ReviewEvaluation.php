<?php

namespace App\Livewire;

use App\Models\Evaluation;
use Livewire\Component;

class ReviewEvaluation extends Component
{
    public $evaluation;

    public function mount(Evaluation $evaluation)
    {
        $this->evaluation = $evaluation->load('evaluationTemplate');
    }

    public function render()
    {
        return view('livewire.review-evaluation');
    }
}
