<?php

namespace Database\Seeders;

use App\Models\Approver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApproverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Approver::create([
            'bu_id' => 1,
            'first_name' => 'Joshua',
            'last_name' => 'Approver',
            'contact_no' => '1234567890',
            'position' => 'Manager',
            'is_active' => 1,
        ]);
    }
}
