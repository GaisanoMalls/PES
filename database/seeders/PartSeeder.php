<?php

namespace Database\Seeders;

use App\Models\Part;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample data for the parts table
        $data = [

            [
                'name' => 'Part 1 Template 2 Area',
                'evaluation_template_id' => 2, // Replace with the appropriate template ID
                'criteria_allocation' => 50.0,
            ],

            // Add more data entries as needed
        ];

        // Insert the sample data into the parts table
        foreach ($data as $item) {
            Part::create($item);
        }
    }
}
