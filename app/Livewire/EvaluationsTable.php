<?php

namespace App\Livewire;

use App\Models\Evaluation;
use App\Models\EvaluationPoint;
use Livewire\Component;

class EvaluationsTable extends Component
{
    public function approveEvaluation($evaluationId)
    {
        $evaluation = Evaluation::find($evaluationId);

        if ($evaluation) {
            // Toggle the status between 1 and 2
            $newStatus = 1;
            $evaluation->update(['status' => $newStatus]);
        }
    }


    public function render()
    {
        $evaluations = Evaluation::with('employee', 'evaluatorEmployee')
            ->where('id', '>', 0)
            ->whereRaw('id % 2 = 1')
            ->get();

        $evaluationTotals = [];

        foreach ($evaluations as $evaluation) {
            $totalPoints = EvaluationPoint::where('evaluation_id', $evaluation->id)->sum('points');
            $evaluationTotals[$evaluation->id] = $totalPoints;
        }

        return view('livewire.evaluations-table', compact('evaluations', 'evaluationTotals'));
    }
}
