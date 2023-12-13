<?php

namespace Database\Seeders;

use App\Models\EvaluationTemplate;
use Illuminate\Database\Seeder;

class EvaluationTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample data for the evaluation_templates table
        $data = [
            [
                'name' => 'Performance Management Evaluation',
                'status' => 1,
            ],
            // Add more data entries as needed
        ];

        // Insert the sample data into the table
        foreach ($data as $item) {
            EvaluationTemplate::create($item);
        }
    }
}
