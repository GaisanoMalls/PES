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
                'person_id' => 1, // Replace with the appropriate person_id from approvers, evaluators, or human resources
                'role_id' => 3,  // Replace with the appropriate role_id (e.g., evaluator, approver, etc.)
                'email' => 'approver@example.com',
                'password' => bcrypt('password1'),
                'is_active' => 1,
            ],
            [
                'person_id' => 1, // Replace with the appropriate person_id from approvers, evaluators, or human resources
                'role_id' => 2,  // Replace with the appropriate role_id (e.g., evaluator, approver, etc.)
                'email' => 'evaluator@example.com',
                'password' => bcrypt('password2'),
                'is_active' => 1,
            ],
            // Add more users as needed
        ];

        // Insert the sample data into the users table
        User::insert($usersData);
    }
}
