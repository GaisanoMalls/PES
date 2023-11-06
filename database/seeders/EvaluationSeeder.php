<?php

namespace Database\Seeders;

use App\Models\Evaluation;
use Illuminate\Database\Seeder;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample data for the evaluations table
        $data = [
            [
                'approver_id' => 1001, // Replace with the appropriate approver ID
                'evaluator_id' => 1002, // Replace with the appropriate evaluator ID
                'employee_id' => 2001, // Replace with the appropriate employee ID
                'evaluation_template_id' => 1, // Replace with the appropriate template ID
                'recommendation_note' => 'Comment note from evaluator 1',
                'ratees_comment' => 'Comment from the employee being evaluated 1',
                'status' => 1, // Replace with the appropriate status
            ],
            [
                'approver_id' => 1001, // Replace with the appropriate approver ID
                'evaluator_id' => 1002, // Replace with the appropriate evaluator ID
                'employee_id' => 2002, // Replace with the appropriate employee ID
                'evaluation_template_id' => 1, // Replace with the appropriate template ID
                'recommendation_note' => 'Another comment note from evaluator 2',
                'ratees_comment' => 'Another comment from the employee being evaluated 2',
                'status' => 1, // Replace with the appropriate status
            ],
            // Add more data entries as needed
        ];

        // Insert the sample data into the evaluations table
        foreach ($data as $item) {
            Evaluation::create($item);
        }
    }
}
