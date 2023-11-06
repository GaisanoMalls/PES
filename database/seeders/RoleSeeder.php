<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Sample data for the roles table
        $data = [
            ['name' => 'Admin'],
            ['name' => 'Evaluator'],
            ['name' => 'Approver'],
            ['name' => 'Employee'],
            ['name' => 'HR'],
        ];

        // Insert data into the roles table
        Role::insert($data);
    }
}
