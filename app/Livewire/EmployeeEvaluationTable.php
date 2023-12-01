<?php

namespace App\Livewire;

use App\Models\Employee;
use Livewire\Component;

class EmployeeEvaluationTable extends Component
{
    public function render()
    {
        // Fetch employees with evaluations
        $employees = Employee::whereHas('evaluations')->get();

        return view('livewire.employee-evaluation-table', [
            'employees' => $employees,
        ]);
    }
}
