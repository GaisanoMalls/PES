<?php

namespace App\Livewire;

use App\Models\Department;
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
    public $departmentFilter = ''; // Add this property

    // Total Rate sorting
    public $sortFieldDate = 'created_at';
    public $sortAscDate = true;

    public $sortFieldTotalRate = 'totalRate';
    public $sortAscTotalRate = true;
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
    protected $listeners = ['deleteEvaluation'];

    public function deleteEvaluation($id)
    {
        $evaluation = Evaluation::find($id);

        // Check if the current user is the evaluator
        if ($evaluation && $evaluation->evaluator_id == Auth::user()->employee_id) {
            // Delete the evaluation
            $evaluation->delete();

            // Delete associated EvaluationPoints
            EvaluationPoint::where('evaluation_id', $evaluation->id)->delete();

            // Optionally, you can return a response if needed
            return response()->json(['message' => 'Evaluation deleted successfully']);
        } else {
            // Optionally, you can add an error message or perform other actions if the user is not authorized to delete
            return response()->json(['message' => 'You are not authorized to delete this evaluation.'], 403);
        }
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

        $departments = Department::all();
        // Search evaluations based on Department
        if ($this->departmentFilter && $this->departmentFilter !== 'All') {
            $evaluationsQuery->whereHas('employee.department', function ($query) {
                $query->where('id', $this->departmentFilter);
            });
        }


        $evaluations = $evaluationsQuery->get();

        $evaluationTotals = [];

        foreach ($evaluations as $evaluation) {
            $totalRate = EvaluationPoint::where('evaluation_id', $evaluation->id)->sum('points');
            $evaluationTotals[$evaluation->id] = $totalRate;
        }



        if ($this->sortFieldTotalRate === 'totalRate') {
            $evaluations = $evaluations->sortBy(function ($evaluation) use ($evaluationTotals) {
                return $evaluationTotals[$evaluation->id];
            }, SORT_REGULAR, !$this->sortAscTotalRate);
        }

        if ($this->sortFieldDate === 'created_at') {
            $evaluations = $evaluations->sortBy('created_at', SORT_REGULAR, !$this->sortAscDate);
        }
        return view('livewire.evaluations-table', compact('evaluations', 'evaluationTotals', 'userRoleId', 'departments'));
    }

    public function search()
    {
    }



    public function sortByTotalRate($field)
    {
        if ($this->sortFieldTotalRate === $field) {
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
