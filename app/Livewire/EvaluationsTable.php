<?php

namespace App\Livewire;

use App\Models\DisapprovalReason;
use App\Models\Evaluation;
use App\Models\EvaluationPoint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EvaluationsTable extends Component
{

    public $evaluationId; // Add this property
    public $showAllEvaluations = true; // Add this property

    public $searchTerm;
    public $recommendationFilter;
    public $statusFilter;

    // Total Rate sorting
    public $sortFieldTotalRate = 'totalRate'; // Default sorting field for Total Rate
    public $sortAscTotalRate = true; // Default sorting order for Total Rate

    // Date of Evaluation sorting
    public $sortFieldDate = 'created_at'; // Default sorting field for Date of Evaluation
    public $sortAscDate = false; // Default sorting order for Date of Evaluation

    public $sortField;




    public function approveEvaluation($evaluationId)
    {
        $evaluation = Evaluation::find($evaluationId);

        if ($evaluation->status === 3) {
            // Delete existing entry in DisapprovalReason
            DisapprovalReason::where('evaluation_id', $evaluation->id)->delete();
        }
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

        // Search evaluations based on employee_id, first name, and last name
        if ($this->searchTerm) {
            $evaluationsQuery->whereHas('employee', function ($query) {
                $query->where('employee_id', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('first_name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('last_name', 'like', '%' . $this->searchTerm . '%');
            });
        }

        // Search evaluations based on Status
        if ($this->statusFilter && $this->statusFilter !== 'All') {
            $evaluationsQuery->where('status', $this->statusFilter);
        } // Search evaluations based on Recommendations
        if ($this->recommendationFilter && $this->recommendationFilter !== 'All') {
            if ($this->recommendationFilter === 'Yes') {
                $evaluationsQuery->whereHas('recommendation');
            } elseif ($this->recommendationFilter === 'No') {
                $evaluationsQuery->doesntHave('recommendation');
            }
        }


        $evaluations = $evaluationsQuery->get();

        $evaluationTotals = [];

        foreach ($evaluations as $evaluation) {
            $totalRate = EvaluationPoint::where('evaluation_id', $evaluation->id)->sum('points');
            $evaluationTotals[$evaluation->id] = $totalRate;
        }

        // Sort evaluations based on the calculated total rate
        $evaluations = collect($evaluations)->sortBy(function ($evaluation) {
            return EvaluationPoint::where('evaluation_id', $evaluation->id)->sum('points');
        })->values();

        // Sort by total rate if the sort field is 'totalRate'
        if ($this->sortFieldTotalRate === 'totalRate') {
            $evaluations = collect($evaluations)->sortBy(function ($evaluation) {
                return EvaluationPoint::where('evaluation_id', $evaluation->id)->sum('points');
            })->values();
        }

        // Sort by date if the sort field is 'created_at'
        if ($this->sortFieldDate === 'created_at') {
            $evaluations = $evaluations->sortBy($this->sortFieldDate, SORT_REGULAR, !$this->sortAscDate)->values();
        }

        // Reverse the order if sorting in descending order
        if (!$this->sortAscTotalRate) {
            $evaluations = $evaluations->reverse();
        }
        return view('livewire.evaluations-table', compact('evaluations', 'evaluationTotals', 'userRoleId'));
    }

    public function search()
    {
    }


    public function sortByTotalRate($field)
    {
        if ($field === $this->sortFieldTotalRate) {
            $this->sortAscTotalRate = !$this->sortAscTotalRate;
        } else {
            $this->sortAscTotalRate = true;
        }

        $this->sortFieldTotalRate = $field;
    }

    public function sortByDate($field)
    {
        if ($field === $this->sortFieldDate) {
            $this->sortAscDate = !$this->sortAscDate;
        } else {
            $this->sortAscDate = false;
        }

        $this->sortFieldDate = $field;
    }
}
