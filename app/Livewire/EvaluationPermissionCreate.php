<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Department;
use App\Models\User;
use Livewire\Component;

class EvaluationPermissionCreate extends Component
{
    public function render()
    {
        // Fetch all branches
        $branches = Branch::all();
        $departments = Department::all();

        // Fetch users with role_id 2 (assuming 'role_id' is the foreign key in the users table)
        $evaluators = User::where('role_id', 2)->get();

        return view('livewire.evaluation-permission-create', [
            'branches' => $branches,
            'evaluators' => $evaluators,
            'departments' => $departments,
        ]);
    }
}
