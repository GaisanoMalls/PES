<?php

namespace App\Livewire;

use App\Models\Approver;
use App\Models\BusinessUnit;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Evaluator;
use App\Models\HumanResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class EmployeeRegistration extends Component
{
    public $role_id = null;

    public $formSubmitted = false; // Step 1: Add this property
    public $evaluatorId; // Add this property to store the Evaluator ID

    //employee details
    public $employeeId;
    public $employeeId2;
    public $employee;

    //evalutor
    public $bu_id;
    public $department_id;
    public $first_name;
    public $last_name;
    public $position;
    public $contact_no;
    public $is_active = 1;


    public $name;
    public $email;
    public $password;
    public $passwordConfirmation;
    public $successMessage;
    protected $rules = [];


    public function mount($employee)
    {
        $this->employeeId = $employee;
    }
    public function render()
    {
        $businessUnits = BusinessUnit::all();
        $departments = Department::all();

        $employee = Employee::find($this->employeeId);
        $this->name = $employee->first_name . ' ' . $employee->last_name;

        // Get the employee_id from the Employee model
        $this->employeeId2 = $employee->employee_id;
        //dd($employeeId2);
        if ($employee) {
            $this->first_name = $employee->first_name;
            $this->last_name = $employee->last_name;
        } else {
            // Handle the case where the employee is null
            return view('livewire.employee-registration', [
                'businessUnits' => $businessUnits,
                'departments' => $departments,
                'employee' => $this->employee,
                'employeeId2' =>  $this->employeeId2,
                'error' => 'Employee not found',
            ]);
        }

        return view('livewire.employee-registration', [
            'businessUnits' => $businessUnits,
            'departments' => $departments,
            'employee' => $employee,
            'employeeId2' => $this->employeeId2, // Pass the employee_id to the view
        ]);
    }


    public function updateForm()
    {
        // Reset the Livewire component's data for the form
        $this->resetValidation();
    }
    public function saveFormRole()
    {
        $this->resetValidation();

        if ($this->role_id == 1 || $this->role_id == 4) {
            $this->formSubmitted = true;
        } elseif ($this->role_id == 2) {
            $this->validate([
                'bu_id' => 'required|numeric',
                'department_id' => 'required|numeric',
                'position' => 'required|string',
                'contact_no' => 'required|string',
            ]);
        } elseif ($this->role_id == 3) {
            $this->validate([
                'bu_id' => 'required|numeric',
                'position' => 'required|string',
                'contact_no' => 'required|string',
            ]);
        } elseif ($this->role_id == 5) {
            $this->validate([
                'position' => 'required|string',
                'contact_no' => 'required|string',
            ]);
        }

        $this->formSubmitted = true;
    }
    public function register()
    {



        // Create a new Evaluator record in the database
        $evaluator = null;
        $approver = null;
        $personId = null;
        $employeeId = null;
        $humanResource = null;
        // Check the selected role and set the appropriate person_id
        if ($this->role_id == 1) {
            $personId = $this->employeeId;
            $employeeId = $this->employeeId;
        } elseif ($this->role_id == 2) { // Evaluator
            $this->validate([
                'bu_id' => 'required|numeric',
                'department_id' => 'required|numeric',
                'position' => 'required|string',
                'contact_no' => 'required|string',
            ]);

            $evaluator = Evaluator::create([
                'bu_id' => $this->bu_id,
                'department_id' => $this->department_id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'contact_no' => $this->contact_no,
                'position' => $this->position,
                'is_active' => $this->is_active,
            ]);
            $personId = $evaluator->id;
            $employeeId = $this->employeeId;
        } else if ($this->role_id == 3) {
            $this->validate([
                'bu_id' => 'required|numeric',
                'position' => 'required|string',
                'contact_no' => 'required|string',
            ]);

            $approver = Approver::create([
                'bu_id' => $this->bu_id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'contact_no' => $this->contact_no,
                'position' => $this->position,
                'is_active' => $this->is_active,
            ]);

            $personId = $approver->id;
            $employeeId = $this->employeeId;
        } else if ($this->role_id == 4) {
            $personId = $this->employeeId;
            $employeeId = $this->employeeId;
        } else if ($this->role_id == 5) {
            $this->validate([
                'position' => 'required|string',
                'contact_no' => 'required|string',
            ]);

            $humanResource = HumanResource::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'contact_no' => $this->contact_no,
                'position' => $this->position,
                'is_active' => $this->is_active,
            ]);
            $personId = $humanResource->id;
            $employeeId = $this->employeeId;
        }

        // Create the user record without specifying person_id initially
        $user = User::create([
            'employee_id' => $employeeId,
            'person_id' => $personId, // Set the person_id if an Evaluator was created
            'role_id' => $this->role_id,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'is_active' => 1,
        ]);
        if ($evaluator) {
            $user->update(['person_id' => $personId]);
            $user->update(['employee_id' => $employeeId]);
        }

        $this->successMessage = 'User registered successfully.';
        $this->reset(['email', 'password', 'passwordConfirmation']);
        return redirect()->route('users.index');
    }
}
