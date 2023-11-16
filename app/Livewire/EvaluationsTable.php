<?php

namespace App\Livewire;

use App\Models\Evaluation;
use App\Models\EvaluationPoint;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EvaluationsTable extends Component
{

    public $evaluationId; // Add this property
    public $showAllEvaluations = true; // Add this property

    public function approveEvaluation($evaluationId)
    {
        $evaluation = Evaluation::find($evaluationId);

        if ($evaluation) {
            // Toggle the status between 1 and 2
            $newStatus = 1;
            $evaluation->update(['status' => $newStatus]);
        }
    }
    public function deleteEvaluation($evaluationId)
    {
        $evaluation = Evaluation::find($evaluationId);

        // Check if the current user is the evaluator
        if ($evaluation && $evaluation->evaluator_id == Auth::user()->employee_id) {
            // Delete the evaluation
            $evaluation->delete();

            // Delete associated EvaluationPoints
            EvaluationPoint::where('evaluation_id', $evaluation->id)->delete();
        } else {
            // Optionally, you can add an error message or perform other actions if the user is not authorized to delete
        }

        // You may also want to redirect the user back to the previous page or perform other actions
    }
    public function toggleShowAllEvaluations()
    {
        $this->showAllEvaluations = !$this->showAllEvaluations;
    }
    public function render()
    {
        $userEmployeeId = Auth::user()->employee_id;
        $userRoleId = Auth::user()->role_id;

        $evaluationsQuery = Evaluation::with('employee', 'evaluatorEmployee');

        // Show only the user's evaluations if the property is set
        if (!$this->showAllEvaluations) {
            $evaluationsQuery->where('evaluator_id', $userEmployeeId);
        }

        // Additional condition for user role 5
        if ($userRoleId == 5) {
            $evaluationsQuery->where('status', 2);
        }

        $evaluations = $evaluationsQuery->get();

        $evaluationTotals = [];

        foreach ($evaluations as $evaluation) {
            $totalPoints = EvaluationPoint::where('evaluation_id', $evaluation->id)->sum('points');
            $evaluationTotals[$evaluation->id] = $totalPoints;
        }

        return view('livewire.evaluations-table', compact('evaluations', 'evaluationTotals', 'userRoleId'));
    }
}
