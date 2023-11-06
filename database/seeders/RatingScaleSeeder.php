<?php

namespace Database\Seeders;

use App\Models\RatingScale;
use Illuminate\Database\Seeder;

class RatingScaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample data for the rating_scales table
        $data = [

            [
                'acronym' => 'A',
                'name' => 'Average',
                'description' => 'Meets expectations and delivers satisfactory results.',
            ],
            [
                'acronym' => 'S',
                'name' => 'Satisfactory',
                'description' => 'Meets expectations and delivers satisfactory results.',
            ],
            [
                'acronym' => 'P',
                'name' => 'Poor',
                'description' => 'Fails to meet expectations and consistently delivers unsatisfactory results.',
            ],
            // Add more data entries as needed
        ];

        // Insert the sample data into the rating_scales table
        foreach ($data as $item) {
            RatingScale::create($item);
        }
    }
}
