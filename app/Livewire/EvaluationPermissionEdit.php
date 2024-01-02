<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Department;
use App\Models\EvaluationPermission;
use Livewire\Component;

class EvaluationPermissionEdit extends Component
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

        return view('livewire.evaluation-permission-edit', [
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

            // Fetch existing EvaluationPermissions for the given employee
            $existingPermissions = EvaluationPermission::where('employee_id', $employeeId)->get();

            // Create an array to store the existing department IDs
            $existingDepartmentIds = [];

            // Loop through existing permissions to get the department IDs
            foreach ($existingPermissions as $permission) {
                $existingDepartmentIds[$permission->branch_id][] = $permission->department_id;
            }

            // Loop through existing departments and delete records that are not in the current selection
            foreach ($existingDepartmentIds as $branchId => $departmentIds) {
                foreach ($departmentIds as $departmentId) {
                    if (!in_array($departmentId, $this->selectedDepartments[$branchId] ?? [])) {
                        // Delete the record for the deselected department
                        EvaluationPermission::where('evaluator_id', $this->selectedEvaluator)
                            ->where('employee_id', $employeeId)
                            ->where('department_id', $departmentId)
                            ->where('branch_id', $branchId)
                            ->delete();
                    }
                }
            }

            // Loop through selected branches and departments and update or add records
            foreach ($this->selectedDepartments as $branchId => $selectedDepartmentIds) {
                foreach ($selectedDepartmentIds as $departmentId) {
                    // Check if the department is already selected
                    if (in_array($departmentId, $existingDepartmentIds[$branchId] ?? [])) {
                        // Department already selected, do nothing
                    } else {
                        // Create a new EvaluationPermission record
                        EvaluationPermission::create([
                            'evaluator_id' => $this->selectedEvaluator,
                            'employee_id' => $employeeId,
                            'department_id' => $departmentId,
                            'branch_id' => $branchId,
                        ]);
                    }
                }
            }

            return redirect()->route('settings.evalpermEdit', ['id' => $employeeId]);
        } catch (\Exception $e) {
            // Log or print the exception message for debugging
            dd($e->getMessage());
        }
    }
}
