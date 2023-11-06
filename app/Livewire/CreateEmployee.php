<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateEmployee extends Component
{
    public $employeeId;
    public $employee;

    public $name;
    public $email;
    public $password;
    public $passwordConfirmation;
    public $role_id;
    public $successMessage;

    public function mount($employee)
    {
        $this->employeeId = $employee;
    }
    public function render()
    {
        $employee = Employee::find($this->employeeId);
        $this->name = $employee->first_name . ' ' . $employee->last_name;
        return view(
            'livewire.create-employee',
            [
                'employee' => $this->employee,
                'employeeId' => $this->employeeId,
            ]
        );
    }
    public function register()
    {

        User::create([
            'person_id' => $this->employeeId,
            'role_id' => $this->role_id,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'is_active' => 1,
        ]);

        $this->successMessage = 'User registered successfully.';
        $this->reset(['email', 'password', 'passwordConfirmation']);
    }
}
