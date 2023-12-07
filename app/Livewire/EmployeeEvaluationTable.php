<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Evaluator;
use Livewire\Component;

class EmployeeEvaluationTable extends Component
{
    public $searchName; // Combine first and last name into a single search term
    public $departmentFilter = ''; // Add this property
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        // Retrieve the current user's department ID
        $currentDepartmentId = auth()->user()->department_id;

        // Retrieve the current user's person ID from the Evaluator table
        $evaluator = Evaluator::where('id', auth()->user()->person_id)->first();

        // If the Evaluator record is found, update the currentDepartmentId
        if ($evaluator) {
            $currentDepartmentId = $evaluator->department_id;
        }

        // Fetch employees with evaluations
        $query = Employee::whereHas('evaluations');

        // If the current user's role is not admin (role_id 1 or 5) and is a manager (role_id 2),
        // filter by the current user's department
        if (auth()->user()->role_id === 2) {
            $query->where('department_id', $currentDepartmentId);
        }

        $departments = Department::all();
        $perPage = 10; // Replace with the desired number of items per page

        if ($this->searchName) {
            $query->where(function ($q) {
                $q->where('first_name', 'like', '%' . $this->searchName . '%')
                    ->orWhere('last_name', 'like', '%' . $this->searchName . '%')
                    ->orWhere(
                        'employee_id',
                        'like',
                        '%' . $this->searchName . '%'
                    );
            });
        }

        if ($this->departmentFilter) {
            $query->whereHas('department', function ($q) {
                $q->where('id', $this->departmentFilter);
            });
        }
        $employees = $query->paginate($perPage);

        // Retrieve the latest evaluation date for each employee
        $latestEvaluationDates = [];
        foreach ($employees as $employee) {
            $latestEvaluation = $employee->evaluations->sortBy('updated_at')->last(); // Sort evaluations by updated_at
            $latestEvaluationDates[$employee->id] = $latestEvaluation ? $latestEvaluation->updated_at->format('Y-m-d H:i:s') : 'N/A';
        }

        return view('livewire.employee-evaluation-table', [
            'employees' => $employees,
            'departments' => $departments,
            'latestEvaluationDates' => $latestEvaluationDates, // Pass the latest evaluation dates to the view
        ]);
    }

    // New method for handling the search
    public function search()
    {
        $this->render();
    }
}
