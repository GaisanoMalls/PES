<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Department;
use App\Models\EvaluationPermission;
use App\Models\User;
use Livewire\Component;

class EvaluationPermissionCreate extends Component
{
    public $selectedEvaluator;
    public $selectedDepartments = [];
    public function render()
    {
        // Fetch all branches
        $branches = Branch::all();
        $departments = Department::all();

        // Fetch users with role_id 2 and exclude those with employee_id in evaluation_permission table
        $evaluators = User::where('role_id', 2)
            ->whereNotIn('employee_id', EvaluationPermission::pluck('employee_id'))
            ->get();

        return view('livewire.evaluation-permission-create', [
            'branches' => $branches,
            'evaluators' => $evaluators,
            'departments' => $departments,
        ]);
    }

    public function saveSelection()
    {
        // Validate that an evaluator is selected
        $this->validate([
            'selectedEvaluator' => 'required',
        ]);

        // Loop through selected branches and departments and store in the database
        foreach ($this->selectedDepartments as $branchId => $selectedDepartmentIds) {
            foreach ($selectedDepartmentIds as $departmentId) {
                EvaluationPermission::create([
                    'evaluator_id' => $this->selectedEvaluator,
                    'employee_id' => optional(User::find($this->selectedEvaluator)->employee)->employee_id,
                    'department_id' => $departmentId,
                    'branch_id' => $branchId,
                ]);
            }
        }

        $this->selectedEvaluator = null;
        $this->selectedDepartments = [];

        return redirect()->route('settings.evalperm');
    }
}
