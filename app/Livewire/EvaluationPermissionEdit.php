<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Department;
use App\Models\EvaluationPermission;
use App\Models\User;
use Livewire\Component;

class EvaluationPermissionEdit extends Component
{
    public $employeeId;
    public $selectedEvaluator;
    public $selectedDepartments = [];

    protected $rules = [
        'selectedEvaluator' => 'required',
    ];

    public function mount($employeeId)
    {
        $this->employeeId = $employeeId;
        $this->loadSelectedEvaluator();
    }

    public function loadSelectedEvaluator()
    {
        $user = User::find($this->employeeId);
        $this->selectedEvaluator = optional($user)->employee_id;
    }

    public function render()
    {
        // Fetch all branches and departments
        $branches = Branch::all();
        $departments = Department::all();

        return view('livewire.evaluation-permission-edit', [
            'branches' => $branches,
            'departments' => $departments,
        ]);
    }

    public function updateSelection()
    {
        $this->validate();

        // Clear existing permissions for the employee
        EvaluationPermission::where('evaluator_id', $this->selectedEvaluator)->delete();

        // Loop through selected branches and departments and store in the database
        foreach ($this->selectedDepartments as $branchId => $selectedDepartmentIds) {
            foreach ($selectedDepartmentIds as $departmentId) {
                EvaluationPermission::create([
                    'evaluator_id' => $this->selectedEvaluator,
                    'employee_id' => $this->employeeId,
                    'department_id' => $departmentId,
                    'branch_id' => $branchId,
                ]);
            }
        }

        // Reset the mode to show after updating
        $this->emit('toggleEditMode');
    }
}
