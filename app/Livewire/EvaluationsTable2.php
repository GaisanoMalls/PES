<?php

namespace App\Livewire;

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
    protected $paginationTheme = 'bootstrap';

    // ... existing code ...

    public function render()
    {
        $userEmployeeId = Auth::user()->employee_id;
        $userRoleId = Auth::user()->role_id;
        $perPage = 10; // Replace with desired number of items per page

        $evaluationsQuery = Evaluation::with('employee', 'evaluatorEmployee');

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
        // Search evaluations based on Department
        if ($this->departmentFilter && $this->departmentFilter !== 'All') {
            $evaluationsQuery->whereHas('employee.department', function ($query) {
                $query->where('id', $this->departmentFilter);
            });
        }

        $evaluationsQuery->orderBy('created_at', 'desc'); // Add this line to sort by the latest

        $evaluations = $evaluationsQuery->paginate($perPage);


        $evaluationTotals = [];

        foreach ($evaluations as $evaluation) {
            $totalRate = EvaluationPoint::where('evaluation_id', $evaluation->id)->sum('points');
            $evaluationTotals[$evaluation->id] = $totalRate;
        }
        $evaluations = $evaluationsQuery->paginate($perPage);

        return view('livewire.evaluations-table2', [
            'evaluations' => $evaluations,
            'evaluationTotals' => $evaluationTotals,
            'userRoleId' => $userRoleId,
            'departments' => $departments
        ]);
    }

    // New method for handling the search
    public function search()
    {
        $this->render();
    }
}
