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

        // Calculate the dates 105 and 175 days ago
        $cutOffDate105Days = now()->subDays(105);
        $cutOffDate175Days = now()->subDays(175);

        // Get employees whose date_hired is exactly 105 or 175 days ago
        $employeesToNotify105Days = Employee::whereDate('date_hired', $cutOffDate105Days)->get();
        $employeesToNotify175Days = Employee::whereDate('date_hired', $cutOffDate175Days)->get();

        // Check if there are employees to notify for each cutoff date
        if ($employeesToNotify105Days->isEmpty() && $employeesToNotify175Days->isEmpty()) {
            $this->info('No employees to notify.');
            return;
        }

        // Prepare the data for the notification
        $subject = 'Employee Notification';

        // Send notifications to each user for the employees whose date_hired is exactly 105 days ago
        foreach ($evaluatorUsers as $user) {
            foreach ($employeesToNotify105Days as $employee) {
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

        // Send notifications to each user for the employees whose date_hired is exactly 175 days ago
        foreach ($evaluatorUsers as $user) {
            foreach ($employeesToNotify175Days as $employee) {
                $body = "{$employee->first_name} {$employee->last_name} has exceeded 175 days since the date of hire.";
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
