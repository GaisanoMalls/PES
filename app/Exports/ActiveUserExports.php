<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ActiveUserExports implements FromQuery, WithHeadings
{

    use Exportable;


    private $columns = ['employee_id', 'first_name', 'last_name', 'department', 'position', 'recommendation_count'];

    public function query()
    {
        return Employee::leftJoin('recommendations', 'employees.employee_id', '=', 'recommendations.employee_id')
            ->leftJoin('departments', 'employees.department_id', '=', 'departments.id') // Adjust the relationship as needed
            ->selectRaw('
                employees.employee_id,
                employees.first_name,
                employees.last_name,
                departments.name as department,
                employees.position as position,
                COUNT(recommendations.id) as recommendation_count
            ')
            ->groupBy('employees.employee_id', 'employees.first_name', 'employees.last_name', 'departments.name', 'employees.position', 'employees.id')
            ->having('recommendation_count', '>', 0)
            ->orderByDesc('recommendation_count');
    }

    public function headings(): array
    {
        return $this->columns;
    }
}
