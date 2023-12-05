<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Employee;
use Livewire\Component;

class EmployeeEvaluationTable extends Component
{
    public $searchName; // Combine first and last name into a single search term
    public $departmentFilter = ''; // Add this property
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        // Fetch employees with evaluations
        $query = Employee::whereHas('evaluations');
        $departments = Department::all();
        $perPage = 10; // Replace with desired number of items per page


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

        return view('livewire.employee-evaluation-table', [
            'employees' => $employees,
            'departments' => $departments
        ]);
    }
    // New method for handling the search
    public function search()
    {
        $this->render();
    }
}
