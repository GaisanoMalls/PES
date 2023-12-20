<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $branches = [
            ['name' => 'DAVAO'],
            ['name' => 'AZUELA'],
            ['name' => 'TORIL'],
            ['name' => 'DIGOS'],
            ['name' => 'TAGUM'],
            ['name' => 'GENERAL SANTOS'],
            ['name' => 'CEBU'],
        ];

        // Insert data into the branches table
        DB::table('branches')->insert($branches);
    }
}
