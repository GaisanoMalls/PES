<?php

namespace Database\Seeders;

use App\Models\Factor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FactorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Sample data for the factors table
        $data = [
            [
                'evaluation_template_id' => 1, // Replace with the appropriate template ID
                'part_id' => 3, // Replace with the appropriate part ID
                'name' => 'A. RESPECT',
                'description' => 'Always keep an open mind and listen and respect the views of others;do not put
down colleagues just because of differences in opinion; respect the management’s
decisions for the company.',
                'alloted' => 4.0,
            ],
            [
                'evaluation_template_id' => 1, // Replace with the appropriate template ID
                'part_id' => 3, // Replace with the appropriate part ID
                'name' => 'B. RESPONSIBILITY',
                'description' => 'Understand duties very well and perform as expected; own up to mistakes; make
things right when wrong; not make any excuses; deliver all commitments; take
care of all company resources.',
                'alloted' => 4.0,
            ],
            [
                'evaluation_template_id' => 1, // Replace with the appropriate template ID
                'part_id' => 3, // Replace with the appropriate part ID
                'name' => 'C. INTEGRITY',
                'description' => 'Say/ keep promises; come to work on time; submit deliverables to internal and
external customers accurately on time all the time;make truthful representations to
customers all the time; ensure accuracy of all the data provided; not engage in 
any fraudulent transactions.',
                'alloted' => 4.0,
            ],
            [
                'evaluation_template_id' => 1, // Replace with the appropriate template ID
                'part_id' => 3, // Replace with the appropriate part ID
                'name' => 'D. TEAMWORK',
                'description' => 'Take initiatives in helping others; value and solicit others’ opinions/inputs/feedback;
set aside personal agenda/comfort for the greater good of the Company; work
harmoniously and collaboratively with colleagues and keep a united stand in front
of customers.',
                'alloted' => 4.0,
            ],
            [
                'evaluation_template_id' => 1, // Replace with the appropriate template ID
                'part_id' => 3, // Replace with the appropriate part ID
                'name' => 'E. EXCELLENCE',
                'description' => 'Do everything the right way the first time all the time;dress up, behave and talk
professionally in word and in writing to internal and external customers; do all work to
the best of his/her abilities; always keep in mind what the customers want; strive for
continuous professional improvement.',
                'alloted' => 4.0,
            ],



        ];

        // Insert the sample data into the factors table
        foreach ($data as $item) {
            Factor::create($item);
        }
    }
}
