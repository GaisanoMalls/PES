<?php

namespace Database\Seeders;

use App\Models\Evaluator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvaluatorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define sample data for evaluators
        $evaluatorsData = [
            [
                'bu_id' => 1,
                'department_id' => 1,
                'first_name' => 'John',
                'last_name' => 'Doe',
                'contact_no' => '123-456-7890',
                'position' => 'Manager',
                'is_active' => 1,
            ],
            [
                'bu_id' => 2,
                'department_id' => 2,
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'contact_no' => '987-654-3210',
                'position' => 'Supervisor',
                'is_active' => 1,
            ],
            // Add more evaluators as needed
        ];

        // Insert the sample data into the evaluators table
        Evaluator::insert($evaluatorsData);
    }
}
