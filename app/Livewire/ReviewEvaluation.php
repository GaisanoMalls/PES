<?php

namespace App\Livewire;

use App\Models\DisapprovalReason;
use App\Models\Employee;
use App\Models\Evaluation;
use App\Models\EvaluationPoint;
use App\Models\Factor;
use App\Models\FactorRatingScale;
use App\Models\NotificationEvaluation;
use App\Models\Part;
use App\Models\RatingScale;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Carbon\Carbon;


use Illuminate\Support\Facades\Mail;
use App\Mail\EmailNotification;
use App\Models\Clarification;
use App\Models\DepartmentConfiguration;
use App\Models\EvaluationApprovers;


class ReviewEvaluation extends Component
{
    public $currentStep = 1;
    public $evaluation;
    public $employeeId;
    public $employee;
    public $departmentName;
    public $employeeIdCompany;
    public $name;
    public $position;
    public $date_hired;

    public $created_at;
    public $ratingScales;
    public $partsWithFactors;

    public $rateeComment;

    public $totalRates = [];
    public $ratingScaleNames = [];
    public $selectedValues = [];
    public $factorNotes = [];
    public $selectedScale = [];

    public $isFormSubmitted = false; // Add this property
    public $disapprovalDescription; // Add this property to store the disapproval description
    public $showClarificationSection = false;

    public $clarificationDescription;
    public $editingClarificationId = null;
    public $disapprovalReason;
    public $approverFirstName;
    public $isEditing = false;
    public function rules()
    {
        return [
            'disapprovalDescription' => 'required',
        ];
    }

    public function mount(Evaluation $evaluation)
    {
        $this->evaluation = $evaluation->load('evaluationTemplate');
        $this->loadEmployeeData();
        $this->loadRatingScales();

        // Load disapproval reason information
        $disapprovalReason = DisapprovalReason::where('evaluation_id', $evaluation->id)->first();

        if ($disapprovalReason) {
            $this->disapprovalReason = $disapprovalReason;

            // Change 'id' to 'employee_id' in the find method
            $approver = Employee::where('employee_id', $disapprovalReason->approver_id)->first();

            $this->approverFirstName = $approver ? $approver->first_name . ' ' . $approver->last_name : '';
        }
    }


    private function loadEmployeeData()
    {
        $this->employee = $this->evaluation->employee;
        $this->departmentName = $this->employee->department->name;
        $this->employeeIdCompany = $this->employee->employee_id;
        $this->name = $this->employee->first_name . ' ' . $this->employee->last_name;
        $this->position = $this->employee->position;
        $this->date_hired = $this->employee->date_hired;
        $this->rateeComment = $this->evaluation->ratees_comment;

        // Convert JSON string to a Carbon date instance
        $this->created_at = Carbon::parse($this->evaluation->created_at)->toDateTimeString();
    }
    public function displayClarificationSection()
    {
        $this->showClarificationSection = true;
    }

    private function loadRatingScales()
    {
        $this->ratingScales = RatingScale::all();
    }

    public function calculateTotalRate()
    {
        $totalRates = [];

        // Loop through each part and calculate the total rate for each part
        foreach ($this->partsWithFactors as $partWithFactors) {
            $partTotal = 0;

            // Loop through factors within each part and calculate their total rate
            foreach ($partWithFactors['factors'] as $factorData) {
                $factorId = $factorData['factor']->id;
                $selectedValue = $this->selectedValues[$factorId] ?? 0;

                // Ensure $selectedValue is always an integer
                if (is_array($selectedValue)) {
                    $partTotal += array_sum($selectedValue);
                } else {
                    $partTotal += (int) $selectedValue; // Convert to integer if not already
                }
            }

            // Store the total rate for this part
            $totalRates[$partWithFactors['part']->id] = $partTotal;
        }

        return $totalRates;
    }

    public $loading = false;

    public function approveEvaluation()
    {
        $this->loading = true; // Set loading to true when the form is being submitted
        $this->dispatch('swal:success2', [
            'callback' => 'redirectAfterClose'
        ]);
        if ($this->isFormSubmitted) {
            return;
        }    // Check if the status is changing from 3 to 2
        if ($this->evaluation->status === 3) {
            // Delete existing entry in DisapprovalReason
            DisapprovalReason::where('evaluation_id', $this->evaluation->id)->delete();
        }

        $departmentConfig = DepartmentConfiguration::where('department_id', $this->evaluation->employee->department_id)
            ->where('branch_id', $this->evaluation->employee->branch_id)
            ->first();

        $numberOfApprovers = $departmentConfig ? $departmentConfig->number_of_approvers : 0;



        $this->evaluation->approver_count += 1; // Increment approver_count by 1
        // Check if approver_count has reached the maximum allowed approver level
        if ($this->evaluation->approver_count == $numberOfApprovers) {
            // Set evaluation status to 2
            $this->evaluation->status = 2;
            $statusLabel = 'Approved';
        } else {
            $this->evaluation->status = 1;
            $statusLabel = 'Partially Approved';
        }

        $this->evaluation->save();
        $user = auth()->user();

        // Find the user who evaluated the performance
        // Find the user who evaluated the performance
        $evaluator = User::where('employee_id', $this->evaluation->evaluator_id)->first();

        // Find all HR users (role_id = 5)
        $hrUsers = User::where('role_id', 5)->get();
        $url = env('APP_URL');

        // Check if the evaluator is found
        if ($evaluator && $evaluator->email) {
            $dataEvaluator = [
                'subject' => $statusLabel . ' Evaluation for ' . $this->evaluation->employee->first_name . ' ' . $this->evaluation->employee->last_name . ' (ID: ' . $this->evaluation->id . ')',
                'body' => 'Level ' . $this->evaluation->approver_count . ' has approved the evaluation for ' . $this->evaluation->employee->first_name . ' ' . $this->evaluation->employee->last_name,
                'link' => $url . 'evaluations/view/' . $this->evaluation->id,
            ];
            // Send email to the evaluator
            Mail::to($evaluator->email)->send(new EmailNotification($dataEvaluator['body'], $dataEvaluator['subject'], $dataEvaluator['link']));
            NotificationEvaluation::create([
                'type' => 'evaluation',
                'notifiable_id' => $evaluator->employee_id,
                'person_id' => $this->evaluation->id,
                'notif_title' => $dataEvaluator['subject'],
                'notif_desc' => $dataEvaluator['body'],
            ]);
            NotificationEvaluation::create([
                'type' => 'evaluation',
                'notifiable_id' => $this->evaluation->employee_id,
                'person_id' => $this->evaluation->id,
                'notif_title' => $dataEvaluator['subject'],
                'notif_desc' => $dataEvaluator['body'],
            ]);
        }



        // Assuming you have the authenticated user
        $currentUser = auth()->user();

        // NOTIFY APPROVER
        if ($departmentConfig) {
            // Access the evaluation_approvers table
            $evaluationApprovers = EvaluationApprovers::where('department_configuration_id', $departmentConfig->id)
                ->get();

            // Get the employee_id from evaluation_approvers and store it on notifiable_id
            foreach ($evaluationApprovers as $approver) {
                $notifiableId = $approver->employee_id;
                $personId = $approver->approver_id;
                $userApprover = $approver->user;

                // Check if the userApprover should be notified
                if ($currentUser && $currentUser->employee_id != $approver->employee_id && $userApprover && $userApprover->email && $this->evaluation->approver_count != $numberOfApprovers) {
                    $url = env('APP_URL');
                    // Prepare the data for the email
                    $data = [
                        'subject' =>  $statusLabel . 'Evaluation for' . $this->evaluation->employee->first_name . ' ' . $this->evaluation->employee->last_name . ' (ID:' . $this->evaluation->id . ')',
                        'body' => 'Level ' . $this->evaluation->approver_count . ' has approved the evaluation for ' . $this->evaluation->employee->first_name . ' ' . $this->evaluation->employee->last_name,
                        'link' => $url . 'evaluations/review/' . $this->evaluation->id,
                    ];
                    // Send email to each approver
                    Mail::to($userApprover->email)->send(new EmailNotification($data['body'], $data['subject'], $data['link']));
                    // Store notification in the database
                    NotificationEvaluation::create([
                        'type' => 'evaluation',
                        'notifiable_id' => $approver->employee_id,
                        'person_id' => $this->evaluation->id,
                        'notif_title' => $data['subject'],
                        'notif_desc' => $data['body'],
                    ]);
                }
            }
        }



        // Check if there are HR users
        if ($this->evaluation->status = 2) {
            if ($hrUsers->count() > 0) {
                $dataHR = [
                    'subject' => 'Approved Evaluation for ' . $this->evaluation->employee->first_name . ' ' . $this->evaluation->employee->last_name . ' (ID: ' . $this->evaluation->id . ')',
                    'body' => 'Evaluation Approved for employee ' . $this->evaluation->employee->first_name . ' ' . $this->evaluation->employee->last_name,
                    'link' => $url . 'evaluations/view/' . $this->evaluation->id,
                ];
                // Send email to each HR user
                foreach ($hrUsers as $hrUser) {
                    if ($hrUser->email) {
                        Mail::to($hrUser->email)->send(new EmailNotification($dataHR['body'], $dataHR['subject'], $dataHR['link']));
                        NotificationEvaluation::create([
                            'type' => 'evaluation',
                            'notifiable_id' => $hrUser->employee_id,
                            'person_id' => $this->evaluation->id,
                            'notif_title' =>  $dataHR['subject'],
                            'notif_desc' => $dataHR['body'],
                        ]);
                    }
                }
            }
        }
        $this->isFormSubmitted = true;
        $this->loading = false; // Set loading back to false after the form submission is complete

        //   return Redirect::to(route('evaluations.index'));
    }
    public function disapproveEvaluation()
    {
        $this->validate(); // Validate the form data

        $this->loading = true; // Set loading to true when the form is being submitted

        if ($this->isFormSubmitted) {
            return;
        }

        $userEmployeeId = Auth::user()->employee_id;
        $this->evaluation->status = 3;

        $this->evaluation->save();

        // Find the user who evaluated the performance
        $evaluator = User::where('employee_id', $this->evaluation->evaluator_id)->first();
        $url = env('APP_URL');

        // Check if the evaluator is found
        if ($evaluator && $evaluator->email) {
            $dataEvaluator = [
                'subject' => 'Disapproved Evaluation for ' . $this->evaluation->employee->first_name . ' ' . $this->evaluation->employee->last_name . ' (ID: ' . $this->evaluation->id . ')',
                'body' => 'Evaluation for ' . $this->evaluation->employee->first_name . ' ' . $this->evaluation->employee->last_name, ' has been disapproved.',
                'link' => $url . 'evaluations/view/' . $this->evaluation->id,
            ];
            // Send email to the evaluator
            Mail::to($evaluator->email)->send(new EmailNotification($dataEvaluator['body'], $dataEvaluator['subject'], $dataEvaluator['link']));
            NotificationEvaluation::create([
                'type' => 'evaluation',
                'notifiable_id' => $evaluator->employee_id,
                'person_id' => $this->evaluation->id,
                'notif_title' => $dataEvaluator['subject'],
                'notif_desc' => $dataEvaluator['body'],
            ]);
        }

        // Store disapproval reason
        DisapprovalReason::create([
            'evaluation_id' => $this->evaluation->id,
            'approver_id' => $userEmployeeId, // Assuming the approver is the authenticated user
            'evaluator_id' => $this->evaluation->evaluator_id, // Assuming you have the evaluator ID available
            'description' => $this->disapprovalDescription,
            'status' =>   $this->evaluation->status, // Set the status as needed
        ]);
        $this->isFormSubmitted = true;
        $this->loading = false; // Set loading back to false after the form submission is complete


        return Redirect::route('evaluations.index');
    }

    public function submitClarification()
    {
        // Validate the input if necessary
        $this->validate([
            'clarificationDescription' => 'required|string',
        ]);

        if ($this->evaluation->status === 3) {
            // Delete existing entry in DisapprovalReason
            DisapprovalReason::where('evaluation_id', $this->evaluation->id)->delete();
        }
        $user = auth()->user();

        // Check if it's an update or a new clarification
        if ($this->editingClarificationId) {
            // Update clarification
            $clarification = Clarification::find($this->editingClarificationId);
            $clarification->description = $this->clarificationDescription;
            $clarification->save();




            // Reset the editing mode
            $this->editingClarificationId = null;
        } else {
            // Save the clarification to the database
            $clarification = new Clarification();
            $clarification->evaluation_id = $this->evaluation->id;
            $clarification->evaluator_id = $this->evaluation->evaluator_id;
            $clarification->description = $this->clarificationDescription;
            $clarification->commentor_id = $user->employee->employee_id;
            $clarification->status = 4;
            $clarification->save();


            // Change the evaluation status
            $this->evaluation->status = 4;

            $this->evaluation->save();

            NotificationEvaluation::create([
                'notifiable_id' => $this->evaluation->evaluator_id,
                'type' => 'evaluation',
                'person_id' => $this->evaluation->id,
                'notif_title' => "Clarificaiton on evaluation ID: " . '' . $this->evaluation->id,
                'notif_desc' => $this->clarificationDescription,
            ]);
        }

        // Clear the input field after submission
        $this->clarificationDescription = '';

        // Refresh the Livewire component or any other necessary action
        $this->dispatch('refreshComponent');
    }

    // Add these methods
    public function editClarification($clarificationId)
    {
        $clarification = Clarification::find($clarificationId);

        if ($clarification) {
            // Set the current description when entering edit mode
            $this->clarificationDescription = $clarification->description;
            $this->editingClarificationId = $clarificationId;
        }
    }

    public function deleteClarification($clarificationId)
    {
        $clarification = Clarification::find($clarificationId);

        if ($clarification) {
            $clarification->delete();
            $this->dispatch('refreshComponent');
        } else {
            // Handle the case where the clarification does not exist (optional)
            // For example, you can show an error message or log the issue.
            // You can also choose to do nothing in this case if it's not critical.
        }
    }

    public function cancelEdit()
    {
        // Reset the editing mode and clear the textarea
        $this->editingClarificationId = null;
        $this->clarificationDescription = '';
    }

    public function submitStep1()
    {
        $this->currentStep = 2;
    }

    public function storeRateeComment()
    {


        $this->loading = true; // Set loading to true when the form is being submitted

        if ($this->isFormSubmitted) {
            return;
        }
        $this->evaluation->update(['ratees_comment' => $this->rateeComment]);
        $this->isEditing = false;

        // Check if notification already exists
        $existingNotification = NotificationEvaluation::where([
            'notifiable_id' => $this->evaluation->evaluator_id,
            'type' => 'evaluation',
            'person_id' => $this->evaluation->id,
        ])->exists();


        if ($this->rateeComment != null) {
            NotificationEvaluation::create([
                'notifiable_id' => $this->evaluation->evaluator_id,
                'type' => 'evaluation',
                'person_id' => $this->evaluation->id,
                'notif_title' => "Employee acknowledged the evaluation (ID: " . '' . $this->evaluation->id,
                'notif_desc' => "The employee has acknowledged the evaluation.",
            ]);
        }

        $this->isFormSubmitted = true;
        $this->loading = false; // Set loading back to false after the form submission is complete


    }
    public function toggleEditMode()
    {
        $this->isEditing = !$this->isEditing;
    }

    public function setEditMode()
    {
        $this->isEditing = true;
    }

    public function setViewMode()
    {
        $this->isEditing = false;
    }


    public function goBack()
    {

        $this->currentStep = 1;
    }

    public function render()
    {
        $this->ratingScales = RatingScale::all();
        $clarifications = Clarification::where('evaluation_id', $this->evaluation->id)->get();

        $department = $this->evaluation->employee->department;
        $branch = $this->evaluation->employee->branch; // Corrected typo: 'brahcn' to 'branch'

        $departmentConfig = DepartmentConfiguration::where('department_id', $department->id)->where('branch_id', $branch->id)->first();
        $departmentConfigId = optional($departmentConfig)->id;

        // Check if $evaluationApprovers is null
        $isDepartmentConfigNull = is_null($departmentConfig);
        // Use conditional check to prevent accessing id property on null object
        $evaluationApprovers = $isDepartmentConfigNull
            ? collect()  // Provide an empty collection if $departmentConfig is null
            : EvaluationApprovers::where('department_configuration_id', $departmentConfigId)->get();

        // Access the number_of_approvers or set it to a default value (e.g., 0) if not found
        $departmentApproversCount = $departmentConfig ? $departmentConfig->number_of_approvers : 0;


        $parts = Part::where('evaluation_template_id', $this->evaluation->evaluation_template_id)->get();
        $this->partsWithFactors = [];
        $totalRateForAllParts = 0; // Initialize the total rate for all parts

        foreach ($parts as $part) {
            $factors = Factor::where('part_id', $part->id)->get();
            $factorsData = [];
            $totalRateForPart = 0; // Initialize the total rate for the part

            foreach ($factors as $factor) {
                $factorData = [
                    'factor' => $factor,
                    'rating_scales' => FactorRatingScale::where([
                        'evaluation_template_id' =>
                        $this->evaluation->evaluation_template_id,
                        'part_id' => $part->id,
                        'factor_id' => $factor->id,
                    ])->get()->map(function ($scale) {
                        $ratingScale = RatingScale::find($scale->rating_scale_id);
                        $scale->acronym = $ratingScale->acronym;
                        $scale->name = $ratingScale->name; // Include the rating scale name
                        return $scale;
                    })

                ];
                $evaluationPoint = EvaluationPoint::where([
                    'evaluation_id' => $this->evaluation->id,
                    'part_id' => $part->id,
                    'factor_id' => $factor->id,
                ])->first();


                $this->selectedValues[$factor->id] = $evaluationPoint->points ?? 0;
                $this->selectedScale[$factor->id] = $evaluationPoint->rating_scale_id ?? 0;
                $this->factorNotes[$factor->id] = $evaluationPoint->note ?? '';

                $totalRateForPart += ($this->selectedValues[$factor->id] ?? 0);
                $factorsData[] = $factorData;
            }

            $this->partsWithFactors[] = [
                'part' => $part,
                'factors' => $factorsData,
                'totalRate' => $totalRateForPart, // Include the total rate in the array
            ];
            $totalRateForAllParts += $totalRateForPart;
        }


        $isApproverLevelValid = ($this->evaluation->status != 2 && $this->evaluation->approver_count >= 0);

        if ($this->evaluation->approver_count >= 0) {
            $departmentConfig = DepartmentConfiguration::where('department_id', $this->evaluation->employee->department_id)
                ->where('branch_id', $this->evaluation->employee->branch_id)
                ->first();

            $maxApproverLevel = $departmentConfig ? $departmentConfig->number_of_approvers : 0;

            $currentUserEmployeeId = auth()->user()->employee_id;
            $currentUserApprover = EvaluationApprovers::where('employee_id', $currentUserEmployeeId)
                ->where('department_configuration_id', $departmentConfig->id)
                ->first();

            if ($currentUserApprover) {
                // Check if the current user's approver level matches the expected level
                if ($currentUserApprover->approver_level === $this->evaluation->approver_count + 1) {
                    // Check if the department_configuration_id matches the current $departmentConfig id
                    $matchingDepartmentConfig = $currentUserApprover->department_configuration_id == $departmentConfig->id;

                    if ($matchingDepartmentConfig) {
                        $isApproverLevelValid = true;
                    } else {
                        $isApproverLevelValid = false;
                    }
                } else {
                    $isApproverLevelValid = false;
                }
            }
        }






        return view('livewire.review-evaluation', [
            'employee' => $this->employee,
            'department' => $this->departmentName,
            'ratingScales' => $this->ratingScales,
            'partsWithFactors' => $this->partsWithFactors,
            'totalRateForAllParts' => $totalRateForAllParts, // Include the total rate for all parts
            'currentStep' => $this->currentStep,
            'clarifications' => $clarifications,
            'departmentApproversCount' => $departmentApproversCount, // Pass the count to the view
            'evaluationApprovers' => $evaluationApprovers,
            'isApproverLevelValid' => $isApproverLevelValid,
            'maxApproverLevel' => $maxApproverLevel, // Include maxApproverLevel in the data array

        ]);
    }
}
