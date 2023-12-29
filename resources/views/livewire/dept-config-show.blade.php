<!-- resources/views/livewire/department-config-edit.blade.php -->

<div class="m-t-30">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Department Configuration</h3>
                </div>
                @if ($selectedDepartment && $config)
                    <div class="card-body">
                        <!-- Display department configuration details -->
                        <div>
                            <strong>Number of Approvers:</strong> {{ $config->number_of_approvers }}
                        </div>
                        <div>
                            <strong>Department Name:</strong> {{ $config->department->name }}
                        </div>
                        <div>
                            <strong>Branch Name:</strong> {{ $config->branch->name }}
                        </div>
                        <!-- Display table of evaluation approvers -->
                        <div class="m-t-30">
                            <h4>Evaluation Approvers</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Level</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($evaluationApprovers as $evalApprover)
                                        <tr>
                                            <td>{{ $evalApprover->employee_id }}</td>
                                            <td>{{ $evalApprover->employee->first_name }}</td>
                                            <td>{{ $evalApprover->employee->last_name }}</td>
                                            <td>{{ $evalApprover->approver_level }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Show the edit form when in edit mode -->
                        @if ($editMode)
                            <div class="card-body">
                                @foreach ($levels as $level)
                                    <div class="col-md-6">
                                        <label class="m-t-15" for="approver_level_{{ $level }}">Approver Level
                                            {{ $level }}:
                                            @php
                                                $currentApprover = $evaluationApprovers->firstWhere('approver_level', $level);
                                            @endphp
                                            @if ($currentApprover)
                                                Current:
                                                {{ $currentApprover->employee->last_name . ', ' . $currentApprover->employee->first_name }}
                                            @else
                                                Current: None
                                            @endif
                                        </label>
                                        <select class="form-control"
                                            wire:model="selectedApprovers.{{ $level }}">
                                            <option value="">Select Approver Level {{ $level }} </option>

                                            @foreach ($this->getApproversForLevel($level) as $approver)
                                                <option value="{{ $approver->id }}">
                                                    {{ $approver->employee->last_name . ', ' . $approver->employee->first_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endforeach
                                <div class="m-t-15">
                                    <div class="col-md-6 text-right">
                                        @if ($canAddLevel)
                                            <button type="button" class="btn btn-primary" wire:click="addLevel">
                                                Add Level
                                            </button>
                                        @endif
                                        <button type="button" class="btn btn-success" wire:click="submitForm">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (!$editMode)
                            <button class="btn btn-secondary" wire:click="toggleEditMode">
                                Edit
                            </button>
                        @else
                            <button class="btn btn-secondary" wire:click="toggleEditMode">
                                Cancel
                            </button>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
