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

class UserController extends Controller
{
    public function index(Request $request)
    {

        $users = User::all(); // Retrieve all users

        return view('admin.index', compact('users'));
    }



    // public function update(Request $request, $id)
    // {
    //     $user = User::find($id);

    //     if (!$user) {
    //         return redirect()->route('admin.index')->with('error', 'User not found');
    //     }

    //     $user->role_id = $request->input('role_id'); // Make sure to use 'role_id'
    //     $user->save();

    //     return redirect()->route('users.index')->with('success', 'User details updated successfully');
    // }
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
                $bu_id = $user->evaluator->businessUnit->id;
                $dept_id = $user->evaluator->department_id;
                $first_name = $user->evaluator->first_name;
                $last_name = $user->evaluator->last_name;
                $contact_no = $user->evaluator->contact_no;
                $position = $user->evaluator->position;
            }
        } elseif ($user->role->id === 3) {
            if ($user->approver) {
                $bu_id = $user->approver->businessUnit->id;
                $dept_id = $user->approver->department_id;
                $first_name = $user->approver->first_name;
                $last_name = $user->approver->last_name;
                $contact_no = $user->approver->contact_no;
                $position = $user->approver->position;
            }
        }


        if (!$user) {
            return redirect()->route('admin.index')->with('error', 'User not found');
        }

        $newRoleId = $request->input('role_id');
        $oldRoleId = $user->role_id;

        // Update the user's role
        $user->role_id = $newRoleId;
        $user->save();

        // Delete the user from the old role's table (e.g., Evaluator)
        if ($oldRoleId == 2) {
            Evaluator::where('id', $user->person_id)->delete();
        } elseif ($oldRoleId == 3) {
            Approver::where('id', $user->person_id)->delete();
        } elseif ($oldRoleId == 5) {
            HumanResource::where('id', $user->person_id)->delete();
        }

        // Create a new record in the appropriate role's table (e.g., Approver)
        if ($newRoleId == 2) { // Evaluator
            $evaluator = Evaluator::create([
                'bu_id' => $bu_id,
                'department_id' => 1,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'contact_no' => $contact_no,
                'position' => $position,
                'is_active' => 1,
            ]);
            $user->update(['person_id' => $evaluator->id]);
        } elseif ($newRoleId == 3) { // Approver
            $approver = Approver::create([
                'bu_id' => $bu_id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'contact_no' => $contact_no,
                'position' => $position,
                'is_active' => 1,
            ]);
            $user->update(['person_id' => $approver->id]);
            // Add more cases for other roles if needed
        }


        return redirect()->route('users.index')->with('success', 'User details updated successfully');
    }



    public function show($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $businessUnits = BusinessUnit::all(); // Retrieve the list of business units


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


        return view('admin.show', compact('user', 'roles', 'businessUnitName', 'businessUnits', 'departmentName'));
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
