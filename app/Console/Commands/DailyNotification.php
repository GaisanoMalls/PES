<?php

namespace App\Console\Commands;

use App\Mail\EmailNotification;
use App\Models\Employee;
use App\Models\EvaluationPermission;
use App\Models\NotificationEmployee;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

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

        // // Get employees whose date_hired is exactly 105 days ago
        $employeesToNotify105Days = Employee::whereDate('date_hired', $cutOffDate105Days)->get();
        // $employeesToNotify105Days = Employee::whereDate('date_hired', $cutOffDate105Days)
        //     ->doesntHave('evaluations') // Check if there are no evaluations for the employee
        //     ->get();


        // $employeesToNotify175Days = Employee::whereDate('date_hired', $cutOffDate175Days)->get();
        // Get employees whose date_hired is exactly 175 days ago
        $employeesToNotify175Days = Employee::whereDate('date_hired', $cutOffDate175Days)
            ->doesntHave('evaluations') // Check if there are no evaluations for the employee
            ->get();


        // Check if there are employees to notify
        if ($employeesToNotify105Days->isEmpty() && $employeesToNotify175Days->isEmpty()) {
            $this->info('No employees to notify.');
            return;
        }

        // Fetch data from evaluation_permission table
        $evaluationPermissions = EvaluationPermission::all();
        $url = env('APP_URL');

        // Send notifications to each user for the employees whose date_hired is exactly 105 days ago
        foreach ($evaluatorUsers as $user) {
            foreach ($employeesToNotify105Days as $employee) {
                // Check if the evaluator is permitted to evaluate the employee
                $isPermitted = $evaluationPermissions
                    ->where('employee_id', $user->employee_id)
                    ->where('department_id', $employee->department_id)
                    ->where('branch_id', $employee->branch_id)
                    ->isNotEmpty();

                if ($isPermitted) {
                    $subject = 'Employee Evaluation Notification: ' . $employee->first_name . ' ' . $employee->last_name;
                    $body = " We hope this message finds you well. We're reaching out to inform you that the employee is now due for an evaluation, having surpassed 105 days since the date of hire." . PHP_EOL . PHP_EOL .
                        "Employee Information" . PHP_EOL . PHP_EOL .
                        "Branch: {$employee->branch->name}" . PHP_EOL . PHP_EOL .
                        "Department: {$employee->department->name}" . PHP_EOL . PHP_EOL .
                        "Employee Name: {$employee->first_name} {$employee->last_name}";


                    $link =  $url . 'employee_evaluations/' . $employee->id;

                    Mail::to($user->email)->send(new EmailNotification($body, $subject, $link));

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
        }

        // Send notifications to each user for the employees whose date_hired is exactly 175 days ago
        foreach ($evaluatorUsers as $user) {
            foreach ($employeesToNotify175Days as $employee) {

                // Check if the evaluator is permitted to evaluate the employee
                $isPermitted = $evaluationPermissions
                    ->where('employee_id', $user->employee_id)
                    ->where('department_id', $employee->department_id)
                    ->where('branch_id', $employee->branch_id)
                    ->isNotEmpty();

                if ($isPermitted) {
                    $subject = 'Employee Evaluation Notification: ' . $employee->first_name . ' ' . $employee->last_name;
                    $body = "URGENT: Action Required!\n\nWe hope this message finds you well. It's crucial to inform you that the employee is now overdue for an evaluation, having surpassed 175 days since the date of hire. This is a red flag, and prompt attention is needed." . PHP_EOL . PHP_EOL .
                        "Employee Information:" . PHP_EOL . PHP_EOL .
                        "Branch: {$employee->branch->name}" . PHP_EOL . PHP_EOL .
                        "Department: {$employee->department->name}" . PHP_EOL . PHP_EOL .
                        "Employee Name: {$employee->first_name} {$employee->last_name}";


                    $link =  $url . 'employee_evaluations/' . $employee->id;

                    Mail::to($user->email)->send(new EmailNotification($body, $subject, $link));
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
        }

        $this->info('Notifications sent successfully.');
    }
}
