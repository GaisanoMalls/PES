<!-- department-config.blade.php -->
<div class="m-t-30">
    <!-- Blade file -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h1>Department Configuration</h1>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="department">Select Department:</label>
                            <select class="form-control" wire:model="selectedDepartment"
                                wire:change="loadDepartmentDetails">
                                <option value="">Select Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label>Branch: </label>
                            <select class="form-control">
                                <option value="1">DAVAO</option>
                            </select>
                        </div>
                    </div>
                </div>
                @if ($selectedDepartment)
                    <div class="card-body">
                        @foreach ($levels as $level)
                            <div class="col-md-6">
                                <label class="m-t-15" for="approver_level_{{ $level }}">Approver Level
                                    {{ $level }}:</label>
                                <select class="form-control" wire:model="selectedApprovers.{{ $level }}">
                                    <option value="">Select Approver Level {{ $level }}</option>
                                    @foreach ($this->getApproversForLevel($level) as $approver)
                                        <option value="{{ $approver->id }}">
                                            {{ $approver->employee->last_name . ', ' . $approver->employee->first_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                        <div class="m-t-15">
                            @if ($canAddLevel)
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn btn-primary" wire:click="addLevel">
                                        Add Level
                                        <!-- SVGO-optimized SVG icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                            height="24" class="main-grid-item-icon" fill="none"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2">
                                            <circle cx="12" cy="12" r="10" />
                                            <line x1="12" x2="12" y1="8" y2="16" />
                                            <line x1="8" x2="16" y1="12" y2="12" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                            <div class="col-md-6 m-t-15">
                                <button type="button" class="btn btn-success" wire:click="submitForm">
                                    Save
                                </button>
                            </div>
                        </div>
                @endif
            </div>
        </div>
    </div>
</div>
