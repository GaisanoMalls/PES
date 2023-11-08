<?php

namespace App\Http\Controllers;

use App\Models\Approver;
use App\Models\BusinessUnit;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Evaluator;
use App\Models\HumanResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $users = User::all(); // Retrieve all users

        return view('admin.index', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $bu_id = null; // Initialize bu_id to null
        $dept_id = null;
        $first_name = null;
        $last_name = null;
        $contact_no = null;
        $position = null;

        if ($user->role->id === 2) {
            if ($user->evaluator) {
                // $bu_id = $user->evaluator->businessUnit->id;
                $first_name = $user->evaluator->first_name;
                $last_name = $user->evaluator->last_name;
                $contact_no = $user->evaluator->contact_no;
                $position = $user->evaluator->position;
            }
        } elseif ($user->role->id === 3) {
            if ($user->approver) {
                //  $bu_id = $user->approver->businessUnit->id;
                $first_name = $user->approver->first_name;
                $last_name = $user->approver->last_name;
                $contact_no = $user->approver->contact_no;
                $position = $user->approver->position;
            }
        } elseif ($user->role->id === 5) {
            if ($user->human_resource) {
                $first_name = $user->human_resource->first_name;
                $last_name = $user->human_resource->last_name;
                $contact_no = $user->human_resource->contact_no;
                $position = $user->human_resource->position;
            }
        }


        if (!$user) {
            return redirect()->route('admin.index')->with('error', 'User not found');
        }

        $newRoleId = $request->input('role_id');
        $oldRoleId = $user->role_id;

        // Validate the email field (you can add additional validation rules as needed)
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        if ($request->has('new_password') && !empty($request->input('new_password'))) {
            $hashedPassword = Hash::make($request->input('new_password'));
            $user->password = $hashedPassword;
        }



        $user->email = $request->input('email'); // Update the user's email
        $user->role_id = $newRoleId; // Update the user's role

        $user->save();


        // Delete the user from the old role's table (e.g., Evaluator)
        if ($oldRoleId == 2) {
            Evaluator::where('id', $user->person_id)->delete();
        } elseif ($oldRoleId == 3) {
            Approver::where('id', $user->person_id)->delete();
        } elseif ($oldRoleId == 5) {
            HumanResource::where('id', $user->person_id)->delete();
        }

        $buId = $request->input('bu_id'); // Get the selected business unit from the input

        // Create a new record in the appropriate role's table (e.g., Approver)
        if ($newRoleId == 2) { // Evaluator
            $departmentId = $request->input('department_id'); // Get the selected department from the input

            $evaluator = Evaluator::create([
                'bu_id' => $buId, // Use the selected business unit
                'department_id' => $departmentId, // Use the selected department
                'first_name' => $first_name,
                'last_name' => $last_name,
                'contact_no' => $contact_no,
                'position' => $position,
                'is_active' => 1,
            ]);
            $user->update(['person_id' => $evaluator->id]);
        } elseif ($newRoleId == 3) { // Approver

            $approver = Approver::create([
                'bu_id' => $buId,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'contact_no' => $contact_no,
                'position' => $position,
                'is_active' => 1,
            ]);
            $user->update(['person_id' => $approver->id]);
            // Add more cases for other roles if needed
        } elseif ($newRoleId == 5) { // Approver
            $human_resource = HumanResource::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'contact_no' => $contact_no,
                'position' => $position,
                'is_active' => 1,
            ]);
            $user->update(['person_id' => $human_resource->id]);
            // Add more cases for other roles if needed
        }


        return redirect()->route('users.index')->with('success', 'User details updated successfully');
    }



    public function show($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $businessUnits = BusinessUnit::all(); // Retrieve the list of business units

        // Retrieve department data from the database
        $departments = Department::all(); // Assuming you have a "Department" model

        $businessUnitName = null; // Initialize businessUnitName to null
        $departmentName = null; // Initialize businessUnitName to null

        if ($user->role->id === 2) {
            // Check if the user's role is "Evaluators"
            if ($user->evaluator) {
                // If the user has an associated Evaluator model, retrieve the bu_id
                $businessUnitName = $user->evaluator->businessUnit->name;
                $departmentName = $user->evaluator->department->name;
            }
        } elseif ($user->role->id === 3) {
            // Check if the user's role is "Evaluators"
            if ($user->approver) {
                // If the user has an associated Evaluator model, retrieve the bu_id
                $businessUnitName = $user->approver->businessUnit->name;
            }
        }


        return view('admin.show', compact('user', 'roles', 'businessUnitName', 'businessUnits', 'departmentName', 'departments'));
    }
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Create a new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }
}
