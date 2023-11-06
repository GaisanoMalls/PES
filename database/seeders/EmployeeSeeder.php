<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Sample data for the employees table
        $data = [
            [
                'department_id' => 1, // Replace with the appropriate department ID
                'employee_id' => '1',
                'branch_name' => 'DAVAO',
                'first_name' => 'Evaluator',
                'last_name' => 'Evaluator_LNAME',
                'contact_no' => '123-456-7890',
                'date_hired' => '2023-01-99', // Date format may vary
                'position' => 'Evaluator_Position',
                'employment_status' => 'Regular',
                'is_active' => 1, // Active
            ],
            [
                'department_id' => 2, // Replace with the appropriate department ID
                'employee_id' => '2',
                'branch_name' => 'DAVAO',
                'first_name' => 'Approver',
                'last_name' => 'Approver_LNAME',
                'contact_no' => '987-654-3210',
                'date_hired' => '2022-11-99', // Date format may vary
                'position' => 'Approver_Position',
                'employment_status' => 'Regular',
                'is_active' => 1, // Active
            ],
            [
                'department_id' => 2, // Replace with the appropriate department ID
                'employee_id' => '3',
                'branch_name' => 'DAVAO',
                'first_name' => 'HR',
                'last_name' => 'HR_LNAME',
                'contact_no' => '987-654-3210',
                'date_hired' => '2022-11-99', // Date format may vary
                'position' => 'HR_Position',
                'employment_status' => 'Regular',
                'is_active' => 1, // Active
            ],
            // Add more data entries as needed
        ];

        // Insert the sample data into the employees table
        foreach ($data as $item) {
            Employee::create($item);
        }
    }
}
