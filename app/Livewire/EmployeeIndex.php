<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EvaluationTemplate;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeIndex extends Component
{
    use WithPagination;

    public $searchName = '';
    public $departmentFilter = '';
    public $branchFilter = '';

    public $employmentStatusFilter = ''; // New property for employment status
    public $paginationTheme = 'bootstrap'; // Use your preferred pagination theme

    public function render()
    {
        // Retrieve the current user's role ID
        $userRoleId = Auth::user()->role_id;
        // Fetch departments
        $departments = Department::all();

        // Fetch branches
        $branches = Branch::all();
        $employmentStatuses = ['REGULAR', 'PROBATIONARY'];


        // Check if the user's role ID is 1 (assuming 1 is the ID for the admin role)
        if ($userRoleId != 2) {
            // If the user is an admin, retrieve all employees without applying evaluation permissions
            $query = Employee::select('employees.*')
                ->with(['department', 'branch'])
                ->where(function ($query) {
                    $query->where('employees.employee_id', 'like', '%' . $this->searchName . '%')
                        ->orWhere('employees.first_name', 'like', '%' . $this->searchName . '%')
                        ->orWhere('employees.last_name', 'like', '%' . $this->searchName . '%');
                })
                ->groupBy('employees.id');
        } else {
            // Retrieve the current user's evaluator ID
            $evaluatorId = Auth::user()->employee_id;
            // dd($evaluatorId);
            // Build the query with evaluation permissions
            $query = Employee::join('evaluation_permissions', function ($join) use ($evaluatorId) {
                $join->on('employees.department_id', '=', 'evaluation_permissions.department_id')
                    ->on('employees.branch_id', '=', 'evaluation_permissions.branch_id')
                    ->where('evaluation_permissions.employee_id', $evaluatorId);
            })
                ->select('employees.*')
                ->with(['department', 'branch'])
                ->where(function ($query) {
                    $query->where('employees.employee_id', 'like', '%' . $this->searchName . '%')
                        ->orWhere('employees.first_name', 'like', '%' . $this->searchName . '%')
                        ->orWhere('employees.last_name', 'like', '%' . $this->searchName . '%');
                })
                ->groupBy('employees.id');
        }

        // Filter employees based on the selected department
        if ($this->departmentFilter) {
            $query->where('employees.department_id', $this->departmentFilter);
        }

        // Filter employees based on the selected branch
        if ($this->branchFilter) {
            $query->where('employees.branch_id', $this->branchFilter);
        }

        // Filter employees based on the selected employment status
        if ($this->employmentStatusFilter) {
            $query->where('employees.employment_status', $this->employmentStatusFilter);
        }

        // Paginate the results
        $employees = $query->paginate(15);

        return view('livewire.employee-index', compact('employees', 'departments', 'branches', 'employmentStatuses'));
    }


    // Add the search method
    public function search()
    {
        // You can add additional logic here if needed
        $this->render(); // Trigger the render method to apply the search
    }
}
