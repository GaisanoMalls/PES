<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EvaluationTemplate;
use Illuminate\Support\Facades\Cache;

class EmployeeController extends Controller
{


    public function index()
    {

        return view('employees.index');
    }

    public function myevaluations()
    {
        return view('employees.myevaluations');
    }

    public function employeesEvaluation()
    {

        return view('employees.evaluations');
    }


    public function employeesEvaluationsView($employee_id)
    {
        return view('employees.evaluations-view', ['selectedEmployeeId' => $employee_id]);
    }
    public function create($employeeId)
    {
        $employee = Employee::where('employee_id', $employeeId)->first();
        return view('employees.create', compact('employee'));
    }

    public function setRole($id)
    {
        // Display a form to create a new employee
        $employee = Employee::find($id);
        return view('employees.role', compact('employee'));
    }

    public function store(Request $request)
    {
        // Validate and store a new employee
        $request->validate([
            'employee_id' => 'required|string|unique:employees|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees',
            'phone_number' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'join_date' => 'required|date',
        ]);

        Employee::create([
            'employee_id' => $request->employee_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'role' => $request->role,
            'join_date' => $request->join_date,
        ]);
        return redirect()->route('employees.index')->with('success', 'Employee created successfully');
    }

    public function show($employeeId)
    {
        $employee = Employee::where('employee_id', $employeeId)->first();
        return view('employees.show', compact('employee'));
    }


    public function edit($id)
    {
        $employee = Employee::find($id);
        $departments = Department::all(); // Assuming your model is named 'Department'

        return view('employees.edit', compact('employee', 'departments'));
    }

    public function update(Request $request, $id)
    {


        $employee = Employee::find($id);
        $employee->update([
            'employee_id' => $request->employee_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'department_id' => $request->department_id,
            'position' => $request->position,
            'employment_status' => $request->employment_status,
            'date_hired' => $request->date_hired,
        ]);

        return redirect()->route('employees.evaluations-view', $employee->id)->with('success', 'Employee updated successfully');
    }

    public function destroy($id)
    {
        // Delete an employee
        $employee = Employee::find($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
    }
}
