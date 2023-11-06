<?php

namespace App\Console\Commands;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Console\Command;

class ImportJsonData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $jsonFilePath = storage_path('json_data/output.json');
        $jsonFile = file_get_contents($jsonFilePath); // Read the JSON file

        $data = json_decode($jsonFile, true);

        foreach ($data as $item) {
            $employeeId = $item['EMPID'] ?? 'DEFAULT_EMPLOYEE_ID';
            $departmentName = $item['DEPARTMENTNAME'] ?? 'Default Department Name';

            // Find the department by name
            $department = Department::where('name', $departmentName)->first();

            // Check if the department exists; if not, create a new one
            if (!$department) {
                $department = new Department();
                $department->name = $departmentName;
                $department->save();
            }

            // Create or update the employee record
            Employee::updateOrcreate(
                ['employee_id' => $employeeId],
                [
                    'department_id' => $department->id,
                    'branch_name' => $item['BRANCHNAME'] ?? 'No branch',
                    'first_name' => $item['FNAME'] ?? 'Unknown',
                    'last_name' => $item['LNAME'] ?? 'Unknown',
                    'date_hired' => $item['DTEHIRED'] ?? now(),
                    'position' => $item['PSITIONNAME'] ?? 'Unknown',
                    'employment_status' => $item['EMPLOYMENTSTATUS'] ?? 'Unknown',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $this->info('JSON data imported successfully.');
    }
}
