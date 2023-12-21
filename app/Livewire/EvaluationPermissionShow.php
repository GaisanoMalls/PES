<?php

namespace App\Livewire;

use App\Models\EvaluationPermission;
use Livewire\Component;

class EvaluationPermissionShow extends Component
{
    public $employeeId;
    public $evaluationPermissions;

    public function mount($employeeId)
    {
        $this->employeeId = $employeeId;
        $this->loadEvaluationPermissions();
    }

    public function loadEvaluationPermissions()
    {
        // Assuming you have a relationship set up in the EvaluationPermission model
        $this->evaluationPermissions = EvaluationPermission::where('employee_id', $this->employeeId)->get();
    }

    public function render()
    {
        return view('livewire.evaluation-permission-show');
    }
}
