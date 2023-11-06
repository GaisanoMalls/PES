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
                'employee_id' => 'EMP001',
                'branch_name' => 'Davao',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'contact_no' => '123-456-7890',
                'date_hired' => '2023-01-15', // Date format may vary
                'position' => 'Manager',
                'employment_status' => 'Regular',
                'is_active' => 1, // Active
            ],
            [
                'department_id' => 2, // Replace with the appropriate department ID
                'employee_id' => 'EMP002',
                'branch_name' => 'Davao',
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'contact_no' => '987-654-3210',
                'date_hired' => '2022-11-20', // Date format may vary
                'position' => 'Developer',
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
