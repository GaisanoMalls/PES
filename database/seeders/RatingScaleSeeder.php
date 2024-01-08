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
                'acronym' => 'O',
                'name' => 'Outstanding',
                'description' => 'Performs/accomplishes the area/factor and exceeds the requirements and standards of the job at least 95% of the time that the opportunity
          to perform presents itself.',
            ],
            [
                'acronym' => 'HA',
                'name' => 'High Average',
                'description' => 'Exceeds at least 85% of the time on the normal level of performance requirements for the area/factor.
          Well above the average; may need minor improvements.',
            ],
            [
                'acronym' => 'A',
                'name' => 'Average',
                'description' => 'Performs/accomplishes the area/factor at least 75% of the time or just as expected or required.
          Sometimes exceeds the standards and could be improved.',
            ],
            [
                'acronym' => 'S',
                'name' => 'Satisfactory',
                'description' => 'Occasionally meets teh requirements or at least 50% of the expected level of performance for the area/factor.
          Finds it difficult to perform/accomplish the area/factor, inadequate in many respect and inconsistent.',
            ],
            [
                'acronym' => 'P',
                'name' => 'Poor',
                'description' => 'Seldom meets the requirements of the performance is below 50% of the job standards.
          Incapable/unwilling to perform the area/factor. ',
            ],
            // Add more data entries as needed
        ];

        // Insert the sample data into the rating_scales table
        foreach ($data as $item) {
            RatingScale::create($item);
        }
    }
}
