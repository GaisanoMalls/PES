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


        $query = Employee::whereHas('evaluations');

        // Add orderBy clause to sort by the latest evaluation date
        $query->orderBy(function ($query) {
            $query->select('updated_at')
                ->from('evaluations')
                ->whereColumn('employee_id', 'employees.id')
                ->latest()
                ->limit(1);
        }, 'desc');

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
            $latestEvaluation = $employee->evaluations->sortByDesc('updated_at')->first(); // Sort evaluations by updated_at in descending order
            $latestEvaluationDates[$employee->id] = $latestEvaluation ? $latestEvaluation->updated_at->format('Y-m-d H:i:s A') : 'N/A';
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
