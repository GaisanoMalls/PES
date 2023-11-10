<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EvaluationTemplate;
use Illuminate\Support\Facades\Cache;

class EmployeeController extends Controller
{


    public function index(Request $request)
    {
        $search = $request->input('search');
        $searchId = $request->input('search_id'); // new input for searching by Employee ID
        $searchRole = $request->input('search_role'); // new input for searching by Role

        $orderBy = $request->input('orderBy', 'employee_id'); // default to sorting by employee_id
        $orderDirection = $request->input('orderDirection', 'asc'); // default to ascending order

        $query = Employee::with('department');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'LIKE', "%$search%")
                    ->orWhere('last_name', 'LIKE', "%$search%");
            });
        }

        if (!empty($searchId)) {
            $query->where('employee_id', 'LIKE', "%$searchId%");
        }
        if (!empty($searchRole)) {
            $query->where('position', $searchRole);
        }
        $employees = $query->orderBy($orderBy, $orderDirection)->paginate(15);


        $evaluationTemplates = EvaluationTemplate::all();

        return view('employees.index', compact('employees', 'evaluationTemplates', 'search', 'orderBy', 'orderDirection'));
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
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update employee details
        $request->validate([
            'name' => 'required|string|max:255',
            'employee_id' => 'required|string|unique:employees|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees',
            'phone_number' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'join_date' => 'required|date',
        ]);

        $employee = Employee::find($id);
        $employee->update([
            'name' => $request->name,
            'employee_id' => $request->employee_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'role' => $request->role,
            'join_date' => $request->join_date,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully');
    }

    public function destroy($id)
    {
        // Delete an employee
        $employee = Employee::find($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
    }
}
