<?php

namespace App\Livewire;

use App\Models\Employee;
use App\Models\Evaluation;
use App\Models\EvaluationPoint;
use Livewire\Component;


class EmployeeDetails extends Component
{
    public $employeeId;

    public function mount($employeeId)
    {
        $this->employeeId = $employeeId;
    }

    public function render()
    {
        $employee = Employee::findOrFail($this->employeeId);
        $evaluations = Evaluation::where('employee_id', $this->employeeId)
            ->orderBy('created_at', 'desc') // Add this line to order by latest date
            ->get();
        $evaluationTotals = [];

        foreach ($evaluations as $evaluation) {
            $totalRate = EvaluationPoint::where('evaluation_id', $evaluation->id)->sum('points');
            $evaluationTotals[$evaluation->id] = $totalRate;
        }

        return view('livewire.employee-details', [
            'employee' => $employee,
            'evaluations' => $evaluations,
            'evaluationTotals' => $evaluationTotals
        ]);
    }
}
