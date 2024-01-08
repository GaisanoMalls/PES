<?php

namespace App\Livewire;

use App\Mail\EmailNotification;
use App\Models\Branch;
use App\Models\Department;
use App\Models\DepartmentConfiguration;
use App\Models\DisapprovalReason;
use App\Models\Evaluation;
use App\Models\EvaluationApprovers;
use App\Models\EvaluationPoint;
use App\Models\NotificationEvaluation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class EvaluationsTable2 extends Component
{
    use WithPagination;

    public $evaluationId;
    public $searchName; // Combine first and last name into a single search term
    public $statusFilter;
    public $recommendationFilter;
    public $departmentFilter = ''; // Add this property
    public $branchFilter = '';
    protected $paginationTheme = 'bootstrap';
    public $showAllEvaluations = true; // Add this property
    public $isProcessing = false;

    public function toggleShowAllEvaluations()
    {
        $this->showAllEvaluations = !$this->showAllEvaluations;
    }

    public function approveEvaluation($evaluationId)
    {
        $evaluation = Evaluation::find($evaluationId);

        if ($evaluation->status === 3) {
            // Delete existing entry in DisapprovalReason
            DisapprovalReason::where('evaluation_id', $evaluation->id)->delete();
        }
        if ($evaluation) {
            // Toggle the status between 1 and 2
            $newStatus = 1;
            $evaluation->update(['status' => $newStatus]);
        }
    }
    public function proccessedEvaluation($evaluationId)
    {
        $this->isProcessing = true;
        $this->dispatch('swal:modalProcessed');


        $evaluation = Evaluation::find($evaluationId);
        $evaluation->status = 5;
        $evaluation->save();

        // Find the user who evaluated the performance
        $evaluator = User::where('employee_id', $evaluation->evaluator_id)->first();

        // Find all HR users (role_id = 5)
        $url = env('APP_URL');

        // Check if the evaluator is found
        if ($evaluator && $evaluator->email) {
            $dataEvaluator = [
                'subject' => 'Processed Evaluation for ' . $evaluation->employee->first_name . ' ' . $evaluation->employee->last_name . ' (ID: ' . $evaluation->id . ')',
                'body' => 'The evaluation for ' . $evaluation->employee->first_name . ' ' . $evaluation->employee->last_name . ' has been successfully processed. ' . $evaluation->approver_count . ' ' . ($evaluation->approver_count === 1 ? 'approval' : 'approvals') . ' have been obtained.',
                'link' => $url . 'evaluations/view/' . $evaluation->id,
            ];
            // Send email to the evaluator
            // Mail::to($evaluator->email)->send(new EmailNotification($dataEvaluator['body'], $dataEvaluator['subject'], $dataEvaluator['link']));
            NotificationEvaluation::create([
                'type' => 'evaluation',
                'notifiable_id' => $evaluator->employee_id,
                'person_id' => $evaluation->id,
                'notif_title' => $dataEvaluator['subject'],
                'notif_desc' => $dataEvaluator['body'],
            ]);
            NotificationEvaluation::create([
                'type' => 'evaluation',
                'notifiable_id' => $evaluation->employee_id,
                'person_id' => $evaluation->id,
                'notif_title' => $dataEvaluator['subject'],
                'notif_desc' => $dataEvaluator['body'],
            ]);
        }


        $departmentConfig = DepartmentConfiguration::where('department_id', $evaluation->employee->department_id)
            ->where('branch_id', $evaluation->employee->branch_id)
            ->first();


        // NOTIFY APPROVER
        if ($departmentConfig) {
            // Access the evaluation_approvers table
            $evaluationApprovers = EvaluationApprovers::where('department_configuration_id', $departmentConfig->id)
                ->get();

            // Get the employee_id from evaluation_approvers and store it on notifiable_id
            foreach ($evaluationApprovers as $approver) {

                $userApprover = $approver->user;

                $url = env('APP_URL');
                // Prepare the data for the email
                $data = [
                    'subject' => 'Processed Evaluation for ' . $evaluation->employee->first_name . ' ' . $evaluation->employee->last_name . ' (ID: ' . $evaluation->id . ')',
                    'body' => 'The evaluation for ' . $evaluation->employee->first_name . ' ' . $evaluation->employee->last_name . ' has been successfully processed. ' . $evaluation->approver_count . ' ' . ($evaluation->approver_count === 1 ? 'approval' : 'approvals') . ' have been obtained.',
                    'link' => $url . 'evaluations/review/' . $evaluation->id,
                ];
                // Send email to each approver
                Mail::to($userApprover->email)->send(new EmailNotification($data['body'], $data['subject'], $data['link']));
                // Store notification in the database
                NotificationEvaluation::create([
                    'type' => 'evaluation',
                    'notifiable_id' => $approver->employee_id,
                    'person_id' => $evaluation->id,
                    'notif_title' => $data['subject'],
                    'notif_desc' => $data['body'],
                ]);
            }
        }

        $this->isProcessing = false;
    }

    public function unproccessedEvaluation($evaluationId)
    {
        $evaluation = Evaluation::find($evaluationId);
        $evaluation->status = 2;
        $evaluation->save();
    }

    public function render()
    {
        $userEmployeeId = Auth::user()->employee_id;
        $userRoleId = Auth::user()->role_id;
        $perPage = 10; // Replace with the desired number of items per page

        $evaluationsQuery = Evaluation::with('employee', 'evaluatorEmployee');

        // Show only the user's evaluations if the property is set
        if (!$this->showAllEvaluations) {
            $evaluationsQuery->where('evaluator_id', $userEmployeeId);
        }

        // Additional condition for user role 5
        if ($userRoleId == 5) {
            $evaluationsQuery->whereIn('status', [2, 5]);
        }

        if ($this->searchName) {
            $evaluationsQuery->where(function ($query) {
                $query->whereHas('employee', function ($subquery) {
                    $subquery->where('first_name', 'like', '%' . $this->searchName . '%')
                        ->orWhere('last_name', 'like', '%' . $this->searchName . '%');
                });
            });
        }
        if ($this->departmentFilter && $this->departmentFilter !== 'All') {
            $evaluationsQuery->whereHas('employee', function ($query) {
                $query->where('department_id', $this->departmentFilter);
            });
        }

        if ($this->branchFilter && $this->branchFilter !== 'All') {
            $evaluationsQuery->whereHas('employee', function ($query) {
                $query->where('branch_id', $this->branchFilter);
            });
        }

        // Search evaluations based on Status
        if ($this->statusFilter && $this->statusFilter !== 'All') {
            $evaluationsQuery->where('status', $this->statusFilter);
        }

        if ($this->recommendationFilter && $this->recommendationFilter !== 'All') {
            if ($this->recommendationFilter === 'Yes') {
                $evaluationsQuery->whereHas('recommendation');
            } elseif ($this->recommendationFilter === 'No') {
                $evaluationsQuery->doesntHave('recommendation');
            }
        }

        $departments = Department::all();
        $branches = Branch::all();

        // Additional condition for user role 3 APPROVER
        if ($userRoleId == 3) {
            // New query for user role 3
            $evaluationsQuery->whereHas('employee.department', function ($query) {
                $query->whereExists(function ($subquery) {
                    $subquery->from('department_configurations')
                        ->join('evaluation_approvers', 'department_configurations.id', '=', 'evaluation_approvers.department_configuration_id')
                        ->where('evaluation_approvers.employee_id', Auth::user()->employee_id)
                        ->whereColumn('department_configurations.department_id', 'employees.department_id')
                        ->whereColumn('department_configurations.branch_id', 'employees.branch_id');
                });
            });
        } else {
            // Original query
            // Show only the user's evaluations if the property is set
            if (!$this->showAllEvaluations) {
                $evaluationsQuery->where('evaluator_id', $userEmployeeId);
            }

            // Additional condition for user role 5
            if ($userRoleId == 5) {
                $evaluationsQuery->whereIn('status', [2, 5]);
            }

            if ($this->searchName) {
                $evaluationsQuery->where(function ($query) {
                    $query->whereHas('employee', function ($subquery) {
                        $subquery->where('first_name', 'like', '%' . $this->searchName . '%')
                            ->orWhere('last_name', 'like', '%' . $this->searchName . '%');
                    });
                });
            }
        }

        $evaluationsQuery->orderBy('created_at', 'desc'); // Add this line to sort by the latest

        $evaluations = $evaluationsQuery->paginate($perPage);

        $evaluationTotals = [];

        foreach ($evaluations as $evaluation) {
            $totalRate = EvaluationPoint::where('evaluation_id', $evaluation->id)->sum('points');
            $evaluationTotals[$evaluation->id] = $totalRate;
        }

        return view('livewire.evaluations-table2', [
            'evaluations' => $evaluations,
            'evaluationTotals' => $evaluationTotals,
            'userRoleId' => $userRoleId,
            'departments' => $departments,
            'branches' => $branches  // Remove the extra space here
        ]);
    }


    public function search()
    {
        // Reset pagination to the first page before applying the search
        $this->resetPage();

        // Trigger the render method to apply the search
        $this->render();
    }
}
