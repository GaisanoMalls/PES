<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;

class CreateEmployee extends Component
{
    public $employee_id;
    public $first_name;
    public $last_name;
    public $email;
    public $phone_number;
    public $role;
    public $join_date;
    public function rules()
    {
        return [
            'employee_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'role' => 'required',
            'join_date' => 'required|date',
        ];
    }

    public function store()
    {
        $this->validate([
            'employee_id' => 'required|string|unique:employees|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees',
            'phone_number' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'join_date' => 'required|date',
        ]);

        Employee::create([
            'employee_id' => $this->employee_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'role' => $this->role,
            'join_date' => $this->join_date,
        ]);

        session()->flash('success', 'Employee created successfully');
        return redirect()->route('employees.index');
    }
    public function render()
    {
        return view('livewire.create-employee');
    }
}
