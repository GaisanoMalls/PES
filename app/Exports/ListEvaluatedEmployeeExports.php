<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ListEvaluatedEmployeeExports implements FromQuery, WithHeadings
{

    use Exportable;

    private $columns = ['employee_id', 'department', 'branch', 'first_name', 'last_name', 'position', 'evaluation_count'];

    public function query()
    {
        return Employee::leftJoin('evaluations', 'employees.employee_id', '=', 'evaluations.employee_id')
            ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')->leftJoin('branches', 'employees.branch_id', '=', 'branches.id') // Adjust the relationship as needed
            ->selectRaw('
                employees.employee_id,
                departments.name as department,
                branches.name as branche,
                employees.first_name,
                employees.last_name,
                employees.position as position,
                COUNT(evaluations.id) as evaluation_count
            ')
            ->groupBy('employees.employee_id', 'departments.name', 'branches.name', 'employees.first_name', 'employees.last_name', 'employees.position', 'employees.id')
            ->having('evaluation_count', '>', 0)
            ->orderByDesc('evaluation_count');
    }

    public function headings(): array
    {
        return $this->columns;
    }
}
