<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define sample data for users
        $usersData = [
            [
                'employee_id' => 2312105223, // Replace with the appropriate person_id from approvers, evaluators, or human resources
                'person_id' => 1,  // Replace with the appropriate role_id (e.g., evaluator, approver, etc.)
                'role_id' => 1,
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12'),
                'is_active' => 1,
            ],
            // Add more users as needed
        ];

        // Insert the sample data into the users table
        User::insert($usersData);
    }
}
