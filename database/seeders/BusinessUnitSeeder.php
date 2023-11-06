<?php

namespace Database\Seeders;

use App\Models\BusinessUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Sample data for the business_units table
        $data = [
            ['name' => 'Business Unit 1'],
            ['name' => 'Business Unit 2'],
            ['name' => 'Business Unit 3'],
        ];

        // Insert data into the business_units table
        BusinessUnit::insert($data);
    }
}
