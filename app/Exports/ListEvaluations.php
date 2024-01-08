<?php

namespace App\Exports;

use App\Models\Evaluation;
use App\Models\EvaluationPoint;
use App\Models\Recommendation;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;

class ListEvaluations implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    private $columns = ['employee_id', 'first_name', 'last_name', 'department', 'branch', 'total_rate', 'evaluated_by', 'recommendations', 'status'];

    public function query()
    {
        return Evaluation::query()
            ->with(['employee', 'evaluatorEmployee'])
            ->orderBy('created_at', 'desc');
    }

    public function headings(): array
    {
        return $this->columns;
    }

    public function map($evaluation): array
    {
        // Calculate total_rate using EvaluationPoint
        $totalRate = EvaluationPoint::where('evaluation_id', $evaluation->id)->sum('points');

        // Get evaluated_by using evaluatorEmployee relationship
        $evaluatedBy = $evaluation->evaluatorEmployee->first_name . ' ' . $evaluation->evaluatorEmployee->last_name;

        // Check if recommendation exists
        $recommendations = Recommendation::where('evaluation_id', $evaluation->id)->exists() ? 'Yes' : 'No';

        // Get status based on the evaluation status
        $status = '';
        switch ($evaluation->status) {
            case 1:
                $status = 'Pending';
                break;
            case 2:
                $status = 'Approved';
                break;
            case 3:
                $status = 'Disapproved';
                break;
            case 4:
                $status = 'Clarifications';
                break;
            case 5:
                $status = 'Processed';
                break;
        }

        return [
            $evaluation->employee->employee_id,
            $evaluation->employee->first_name,
            $evaluation->employee->last_name,
            $evaluation->employee->department->name,
            $evaluation->employee->branch->name,
            $totalRate,
            $evaluatedBy,
            $recommendations,
            $status,
        ];
    }
}
