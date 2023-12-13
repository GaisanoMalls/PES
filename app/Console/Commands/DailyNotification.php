<?php

namespace App\Console\Commands;

use App\Models\Employee;
use App\Models\NotificationEmployee;
use App\Models\User;
use Illuminate\Console\Command;

class DailyNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:notification';



    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily notifications to users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get all users with role_id 3
        $evaluatorUsers = User::where('role_id', 2)->get();

        // Check if there are users to notify
        if ($evaluatorUsers->isEmpty()) {
            $this->info('No users to notify.');
            return;
        }

        // Calculate the date 105 days ago
        $cutOffDate = now()->subDays(105);

        // Get employees whose date_hired is exactly 105 days ago
        $employeesToNotify = Employee::whereDate('date_hired', $cutOffDate)->get();

        // Check if there are employees to notify
        if ($employeesToNotify->isEmpty()) {
            $this->info('No employees to notify.');
            return;
        }

        // Prepare the data for the notification
        $subject = 'Employee Notification';

        // Send notifications to each user for the employees whose date_hired is exactly 105 days ago
        foreach ($evaluatorUsers as $user) {
            foreach ($employeesToNotify as $employee) {
                // Include first name and last name in the notification body
                $body = "{$employee->first_name} {$employee->last_name} has exceeded 105 days since the date of hire.";

                // Store notification in the database
                NotificationEmployee::create([
                    'type' => 'employee',
                    'notifiable_id' => $user->employee_id,
                    'person_id' => $employee->id,
                    'notif_title' => $subject,
                    'notif_desc' => $body,
                ]);
            }
        }

        $this->info('Notifications sent successfully.');
    }
}
