<?php

namespace App\Livewire;

use App\Models\Employee;
use App\Models\EvaluationTemplate;
use Livewire\Component;
use WithPagination;

class EmployeeIndex extends Component
{


    public $evaluationTemplates;

    public function mount()
    {
        // Load all evaluation templates
        $this->evaluationTemplates = EvaluationTemplate::all();
    }

    public function render()
    {
        $employees = Employee::with('department')->paginate(100);

        return view('livewire.employee-index', compact('employees'));
    }
}
