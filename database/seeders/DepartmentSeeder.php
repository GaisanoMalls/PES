<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $departments = [
            "ICT",
            "HRD",
            "MARKETING",
            "FINANCE",
            "LEASING",
            "FOOD AND BEVERAGE",
            "SUPERMARKET",
            "SPECIALTY STORE",
            "CORPORATE",
            "DEPARTMENT STORE",
            "FOOD AND BEVERAGE",
            "FINANCE",
            "DEPARTMENT STORE",
            "FPM",
            "ENGINEERING",
            "LOGISTICS",
            "DEPARTMENT STORE",
            "CINEMA",
            "DEPARTMENT STORE",
            "MARKETING",
            "TRMO",
            "ADMIN SUPPORT",
            "NUP",
            "CCTV"
        ];


        foreach ($departments as $departmentName) {
            Department::create([
                'name' => $departmentName,
            ]);
        }
    }
}
