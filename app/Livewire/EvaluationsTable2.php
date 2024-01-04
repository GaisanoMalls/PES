<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Department;
use App\Models\DisapprovalReason;
use App\Models\Evaluation;
use App\Models\EvaluationPoint;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class EvaluationsTable2 extends Component
{
    use WithPagination;

    public $evaluationId;
    public $searchName; // Combine first and last name into a single search term
    public $statusFilter;
    public $recommendationFilter;
    public $departmentFilter = ''; // Add this property
    public $branchFilter = '';
    protected $paginationTheme = 'bootstrap';
    public $showAllEvaluations = true; // Add this property

    public function toggleShowAllEvaluations()
    {
        $this->showAllEvaluations = !$this->showAllEvaluations;
    }

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

    public function render()
    {
        $userEmployeeId = Auth::user()->employee_id;
        $userRoleId = Auth::user()->role_id;
        $perPage = 10; // Replace with the desired number of items per page

        $evaluationsQuery = Evaluation::with('employee', 'evaluatorEmployee');

        // Show only the user's evaluations if the property is set
        if (!$this->showAllEvaluations) {
            $evaluationsQuery->where('evaluator_id', $userEmployeeId);
        }

        // Additional condition for user role 5
        if ($userRoleId == 5) {
            $evaluationsQuery->where('status', 2);
        }

        if ($this->searchName) {
            $evaluationsQuery->where(function ($query) {
                $query->whereHas('employee', function ($subquery) {
                    $subquery->where('first_name', 'like', '%' . $this->searchName . '%')
                        ->orWhere('last_name', 'like', '%' . $this->searchName . '%');
                });
            });
        }
        if ($this->departmentFilter && $this->departmentFilter !== 'All') {
            $evaluationsQuery->whereHas('employee', function ($query) {
                $query->where('department_id', $this->departmentFilter);
            });
        }

        if ($this->branchFilter && $this->branchFilter !== 'All') {
            $evaluationsQuery->whereHas('employee', function ($query) {
                $query->where('branch_id', $this->branchFilter);
            });
        }

        // Search evaluations based on Status
        if ($this->statusFilter && $this->statusFilter !== 'All') {
            $evaluationsQuery->where('status', $this->statusFilter);
        }

        if ($this->recommendationFilter && $this->recommendationFilter !== 'All') {
            if ($this->recommendationFilter === 'Yes') {
                $evaluationsQuery->whereHas('recommendation');
            } elseif ($this->recommendationFilter === 'No') {
                $evaluationsQuery->doesntHave('recommendation');
            }
        }

        $departments = Department::all();
        $branches = Branch::all();

        // Additional condition for user role 3
        if ($userRoleId == 3) {
            // New query for user role 3
            $evaluationsQuery->whereHas('employee.department', function ($query) {
                $query->whereExists(function ($subquery) {
                    $subquery->from('department_configurations')
                        ->join('evaluation_approvers', 'department_configurations.id', '=', 'evaluation_approvers.department_configuration_id')
                        ->where('evaluation_approvers.employee_id', Auth::user()->employee_id)
                        ->whereColumn('department_configurations.department_id', 'employees.department_id')
                        ->whereColumn('department_configurations.branch_id', 'employees.branch_id');
                });
            });
        } else {
            // Original query
            // Show only the user's evaluations if the property is set
            if (!$this->showAllEvaluations) {
                $evaluationsQuery->where('evaluator_id', $userEmployeeId);
            }

            // Additional condition for user role 5
            if ($userRoleId == 5) {
                $evaluationsQuery->where('status', 2);
            }

            if ($this->searchName) {
                $evaluationsQuery->where(function ($query) {
                    $query->whereHas('employee', function ($subquery) {
                        $subquery->where('first_name', 'like', '%' . $this->searchName . '%')
                            ->orWhere('last_name', 'like', '%' . $this->searchName . '%');
                    });
                });
            }
        }

        $evaluationsQuery->orderBy('created_at', 'desc'); // Add this line to sort by the latest

        $evaluations = $evaluationsQuery->paginate($perPage);

        $evaluationTotals = [];

        foreach ($evaluations as $evaluation) {
            $totalRate = EvaluationPoint::where('evaluation_id', $evaluation->id)->sum('points');
            $evaluationTotals[$evaluation->id] = $totalRate;
        }

        return view('livewire.evaluations-table2', [
            'evaluations' => $evaluations,
            'evaluationTotals' => $evaluationTotals,
            'userRoleId' => $userRoleId,
            'departments' => $departments,
            'branches' => $branches  // Remove the extra space here
        ]);
    }


    public function search()
    {
        // Reset pagination to the first page before applying the search
        $this->resetPage();

        // Trigger the render method to apply the search
        $this->render();
    }
}
