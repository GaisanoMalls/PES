<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $departments = ['ICT', 'Marketing', 'Finance', 'Sales', 'HR'];

        foreach ($departments as $departmentName) {
            Department::create([
                'name' => $departmentName,
            ]);
        }
    }
}
