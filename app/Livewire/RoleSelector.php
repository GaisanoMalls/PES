<?php

namespace App\Livewire;

use App\Models\BusinessUnit;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Evaluator;
use Livewire\Component;

class RoleSelector extends Component
{
    public $role_id = null;


    //employee details
    public $employeeId;
    public $employee;

    //evalutor
    public $bu_id;
    public $department_id;
    public $first_name;
    public $last_name;
    public $position;
    public $contact_no;
    public $is_active = 1;
    public function mount($employee)
    {
        $this->employeeId = $employee;
    }
    public function render()
    {
        $businessUnits = BusinessUnit::all();
        $departments = Department::all();

        $employee = Employee::find($this->employeeId);

        if ($employee) {
            $this->first_name = $employee->first_name;
            $this->last_name = $employee->last_name;
        } else {
            // Handle the case where the employee is null
            return view('livewire.role-selector', [
                'businessUnits' => $businessUnits,
                'departments' => $departments,
                'employee' => null,
                'employeeId' => $this->employeeId,
                'error' => 'Employee not found',
            ]);
        }

        return view('livewire.role-selector', [
            'businessUnits' => $businessUnits,
            'departments' => $departments,
            'employee' => $employee,
            'employeeId' => $this->employeeId,
        ]);
    }

    public function updateForm()
    {
        // Reset the Livewire component's data for the form
        $this->resetValidation();

        // You can customize the logic to update the form content based on the selected role
        // For example, if role_id is 2 (Evaluator), show the Evaluator form fields
        // If role_id is 3 (Approver), show the Approver form fields
        // For other roles, you can handle them accordingly
    }
    public function saveEvaluator()
    {
        $this->validate([
            'bu_id' => 'required',
            'department_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_no' => 'required',
            'position' => 'required',
        ]);

        // Create a new Evaluator record in the database
        Evaluator::create([
            'person_id' => $this->employeeId,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'bu_id' => $this->bu_id,
            'department_id' => $this->department_id,
            'position' => $this->position,
            'contact_no' => $this->contact_no,
            'is_active' => $this->is_active,
        ]);

        // Reset the form fields
        $this->reset();
    }
}
