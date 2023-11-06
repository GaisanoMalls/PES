<?php

namespace Database\Seeders;

use App\Models\HumanResource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HumanResourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define sample data for human resources
        $humanResourcesData = [
            [
                'first_name' => 'Alice',
                'last_name' => 'Johnson',
                'contact_no' => '123-456-7890',
                'position' => 'HR Manager',
                'is_active' => 1,
            ],
            [
                'first_name' => 'Bob',
                'last_name' => 'Smith',
                'contact_no' => '987-654-3210',
                'position' => 'HR Specialist',
                'is_active' => 1,
            ],
            // Add more human resources as needed
        ];

        // Insert the sample data into the human_resources table
        HumanResource::insert($humanResourcesData);
    }
}
