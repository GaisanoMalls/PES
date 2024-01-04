<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Evaluator;
use Livewire\Component;
use Carbon\Carbon;

class EmployeeEvaluationTable extends Component
{
    public $searchName; // Combine first and last name into a single search term
    public $departmentFilter = '';
    public $branchFilter = ''; // Add branch filter
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $query = Employee::whereHas('evaluations');

        // Add orderBy clause to sort by the latest evaluation date
        $query->orderBy(function ($query) {
            $query->select('updated_at')
                ->from('evaluations')
                ->whereColumn('employee_id', 'employees.employee_id') // Changed to reference employee_id in employees table
                ->latest()
                ->limit(1);
        }, 'desc');

        $departments = Department::all();
        $branches = Branch::all(); // Assuming you have a Branch model

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

        if ($this->branchFilter) {
            $query->whereHas('branch', function ($q) {
                $q->where('id', $this->branchFilter);
            });
        }

        $employees = $query->paginate($perPage);

        // Retrieve the latest evaluation date for each employee
        $latestEvaluationDates = [];
        foreach ($employees as $employee) {
            $latestEvaluation = $employee->evaluations->sortByDesc('updated_at')->first(); // Sort evaluations by updated_at in descending order
            $latestEvaluationDates[$employee->employee_id] = $latestEvaluation ? Carbon::parse($latestEvaluation->updated_at)->format('F d, Y g:i A') : 'N/A';
        }

        return view('livewire.employee-evaluation-table', [
            'employees' => $employees,
            'departments' => $departments,
            'branches' => $branches, // Pass the branches to the view
            'latestEvaluationDates' => $latestEvaluationDates,
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
