<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\DepartmentConfiguration;
use App\Models\EvaluationApprovers;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class DeptConfigShow extends Component
{
    public $configId;
    public $selectedDepartment;
    public $departmentName;
    public $approvers;
    public $selectedApprovers = [];
    public $levels = [];
    public $editMode = false; // Add a property to control edit mode

    public function mount($id)
    {
        $this->configId = $id;

        $config = DepartmentConfiguration::find($id);

        // Load existing configuration details
        if ($config) {
            $this->selectedDepartment = $config->department_id;
            $this->loadDepartmentDetails();
        }
    }
    public function render()
    {
        $departments = Department::all();
        $config = DepartmentConfiguration::find($this->configId);

        $evaluationApprovers = EvaluationApprovers::where('department_configuration_id', $this->configId)
            ->with('employee') // Load the related employee details
            ->get();


        return view('livewire.dept-config-show', [
            'departments' => $departments,
            'approvers' => $this->approvers,
            'canAddLevel' => $this->canAddLevel(),
            'selectedDepartment' => $this->selectedDepartment,
            'departmentName' => $this->departmentName,
            'config' => $config,
            'evaluationApprovers' => $evaluationApprovers, // Pass the evaluation approvers to the view
        ]);
    }
    // Add a method to toggle edit mode
    public function toggleEditMode()
    {
        $this->editMode = !$this->editMode;
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

    // Method to handle the form submission
    public function submitForm()
    {
        // Update the existing DepartmentConfiguration record
        $departmentConfiguration = DepartmentConfiguration::find($this->configId);

        if ($departmentConfiguration) {
            $departmentConfiguration->update([
                'number_of_approvers' => count($this->selectedApprovers),
                'department_id' => $this->selectedDepartment,
                // Add other fields you want to update
            ]);

            // Delete existing EvaluationApprovers records for this configuration
            EvaluationApprovers::where('department_configuration_id', $this->configId)->delete();

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
            return Redirect::route('settings.deptconfig');

            // You can add any additional logic or redirects here
        }
    }
}
