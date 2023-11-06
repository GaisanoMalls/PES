<?php

namespace Database\Seeders;

use App\Models\EvaluationPoint;
use Illuminate\Database\Seeder;

class EvaluationPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample data for the evaluation_points table
        $data = [
            [
                'evaluation_id' => 1, // Replace with the appropriate evaluation ID
                'evaluator_id' => 1002, // Replace with the appropriate evaluator ID
                'employee_id' => 1, // Replace with the appropriate employee ID
                'evaluation_template_id' => 1, // Replace with the appropriate template ID
                'part_id' => 1, // Replace with the appropriate part ID
                'factor_id' => 1, // Replace with the appropriate factor ID
                'rating_scale_id' => 1, // Replace with the appropriate rating scale ID
                'factor_rating_scale_id' => 1, // Replace with the appropriate factor rating scale ID
                'points' => 25.0,
                'note' => 'Note for the first evaluation point',
            ],
            [
                'evaluation_id' => 1, // Replace with the appropriate evaluation ID
                'evaluator_id' => 1002, // Replace with the appropriate evaluator ID
                'employee_id' => 1, // Replace with the appropriate employee ID
                'evaluation_template_id' => 1, // Replace with the appropriate template ID
                'part_id' => 1, // Replace with the appropriate part ID
                'factor_id' => 2, // Replace with the appropriate factor ID
                'rating_scale_id' => 1, // Replace with the appropriate rating scale ID
                'factor_rating_scale_id' => 5, // Replace with the appropriate factor rating scale ID
                'points' => 15.0,
                'note' => 'Note for the second evaluation point',
            ],
            // Add more data entries as needed
        ];

        // Insert the sample data into the evaluation_points table
        foreach ($data as $item) {
            EvaluationPoint::create($item);
        }
    }
}
