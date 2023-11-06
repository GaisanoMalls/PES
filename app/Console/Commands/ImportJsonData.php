<?php

namespace App\Console\Commands;

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
            $branchName = $item['BRANCHNAME'] ?? 'No branch';
            $firstName = $item['FNAME'] ?? 'Unknown';
            $lastName = $item['LNAME'] ?? 'Unknown';
            $dateHired = $item['DTEHIRED'] ?? now();
            $position = $item['PSITIONNAME'] ?? 'Unknown';
            $employmentStatus = $item['EMPLOYMENTSTATUS'] ?? 'Unknown';

            Employee::create([
                'employee_id' => $employeeId,
                'department_id' => 1,
                'branch_name' => $branchName,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'date_hired' => $dateHired,
                'position' => $position,
                'employment_status' => $employmentStatus,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->info('JSON data imported successfully.');
    }
}
