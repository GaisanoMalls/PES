<?php

namespace App\Livewire;

use App\Models\Approver;
use App\Models\Branch;
use Livewire\Component;
use App\Models\Department;
use App\Models\DepartmentConfiguration;
use App\Models\EvaluationApprovers;
use App\Models\User;

class DepartmentConfig extends Component
{
    public $selectedDepartment;
    public $departmentName;
    public $approvers;
    public $selectedApprovers = [];
    public $levels = [];

    public $selectedBranch;

    public function render()
    {
        $departments = Department::all();
        $branches = Branch::all(); // Fetch branches

        return view('livewire.department-config', [
            'departments' => $departments,
            'branches' => $branches, // Pass branches to the view
            'approvers' => $this->approvers,
            'canAddLevel' => $this->canAddLevel(),
        ]);
    }


    // This method is triggered when the selected department changes
    public function loadDepartmentDetails()
    {
        // Fetch department details based on the selected department ID
        $department = Department::find($this->selectedDepartment);

        // Update the departmentName property with the department name
        $this->departmentName = $department ? $department->name : null;

        // Fetch Approvers for the selected department
        $this->approvers = User::where('role_id', 3)->get();

        // Set the number of levels dynamically based on user input
        $this->levels = range(1, count($this->selectedApprovers) + 1);
    }

    // Method to add a level dynamically
    public function addLevel()
    {
        $this->loadDepartmentDetails(); // Refresh levels based on the new count
    }
    // Method to get available Approvers for the specified level
    public function getApproversForLevel($level)
    {
        if ($this->approvers) {
            $selectedApprovers = array_slice($this->selectedApprovers, 0, $level - 1);
            return $this->approvers->whereNotIn('id', $selectedApprovers);
        }

        return collect(); // Return an empty collection if $this->approvers is null
    }
    // Method to check if it's possible to add another level
    public function canAddLevel()
    {
        $nextLevel = count($this->levels) + 1;
        return count($this->getApproversForLevel($nextLevel)) > 0;
    }


    public function submitForm()
    {
        // Check if the DepartmentConfiguration record already exists
        $existingConfiguration = DepartmentConfiguration::where('department_id', $this->selectedDepartment)
            ->where('branch_id', $this->selectedBranch)
            ->first();

        // If the record already exists, set an error message and return
        if ($existingConfiguration) {
            session()->flash('error', 'The selected Department and Branch already exist.');
            return;
        }

        // Create a new DepartmentConfiguration record
        $departmentConfiguration = DepartmentConfiguration::create([
            'number_of_approvers' => count($this->selectedApprovers),
            'department_id' => $this->selectedDepartment,
            'branch_id' => $this->selectedBranch,
        ]);

        // Save the Approvers for each level in the EvaluationApprovers table
        foreach ($this->selectedApprovers as $level => $approverId) {
            $approver = User::find($approverId);

            if ($approver) {
                EvaluationApprovers::create([
                    'approver_id' => $approver->person_id,
                    'employee_id' => $approver->employee_id,
                    'department_configuration_id' => $departmentConfiguration->id,
                    'approver_level' => $level,
                ]);
            }
        }

        // Optionally, you can reset the form after submission
        $this->reset();
        $this->dispatch('showSuccessAlert', ['message' => 'Form submitted successfully!']);
    }
}
