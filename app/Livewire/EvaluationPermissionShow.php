<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Department;
use App\Models\EvaluationPermission;
use Livewire\Component;

class EvaluationPermissionShow extends Component
{
    public $employeeId;
    public $selectedDepartments = [];

    public $selectedEvaluator;

    public function mount($employeeId)
    {
        $this->employeeId = $employeeId;

        // Fetch the evaluator_id for the given employee
        $evaluatorId = EvaluationPermission::where('employee_id', $employeeId)->value('evaluator_id');
        $this->selectedEvaluator = $evaluatorId;

        // Fetch EvaluationPermissions for the given employee
        $evaluationPermissions = EvaluationPermission::where('employee_id', $this->employeeId)->get();

        // Initialize an array to store pre-selected departments
        $preSelectedDepartments = [];

        // Loop through EvaluationPermissions to pre-select departments
        foreach ($evaluationPermissions as $permission) {
            $preSelectedDepartments[$permission->branch_id][] = $permission->department_id;
        }

        // Set the selected departments
        $this->selectedDepartments = $preSelectedDepartments;
    }

    public function render()
    {
        // Fetch all branches and departments
        $branches = Branch::all();
        $departments = Department::all();

        // Fetch EvaluationPermissions for the given employee
        $evaluationPermissions = EvaluationPermission::where('employee_id', $this->employeeId)->get();

        // Initialize an array to store pre-selected departments
        $preSelectedDepartments = [];

        // Loop through EvaluationPermissions to pre-select departments
        foreach ($evaluationPermissions as $permission) {
            $preSelectedDepartments[$permission->branch_id][] = $permission->department_id;
        }

        return view('livewire.evaluation-permission-show', [
            'branches' => $branches,
            'departments' => $departments,
            'preSelectedDepartments' => $preSelectedDepartments,
            'evaluationPermissions' => $evaluationPermissions, // Pass the data to the view

        ]);
    }
    public function updateSelection()
    {
        try {
            // Fetch the employee_id based on the evaluator_id
            $employeeId = EvaluationPermission::where('evaluator_id', $this->selectedEvaluator)
                ->value('employee_id');

            // Delete existing records for the selected evaluator and employee
            EvaluationPermission::where('evaluator_id', $this->selectedEvaluator)
                ->where('employee_id', $employeeId)
                ->delete();

            // Loop through selected branches and departments and store in the database
            foreach ($this->selectedDepartments as $branchId => $selectedDepartmentIds) {
                foreach ($selectedDepartmentIds as $departmentId) {
                    // Create a new EvaluationPermission record
                    EvaluationPermission::create([
                        'evaluator_id' => $this->selectedEvaluator,
                        'employee_id' => $employeeId,
                        'department_id' => $departmentId,
                        'branch_id' => $branchId,
                    ]);
                }
            }

            // Add any additional logic or success messages here

            return redirect()->route('settings.evalpermEdit', ['id' => $employeeId]);
        } catch (\Exception $e) {
            // Log or print the exception message for debugging
            dd($e->getMessage());
        }
    }
}
