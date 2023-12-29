<div class="m-t-30">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Evaluation Permission</h3>
                </div>
                <div class="card-body">
                    <h6>Employee ID: {{ $employeeId }}</h6>
                    <h6>Evaluator ID: {{ $selectedEvaluator }}</h6>
                    <p>Employee Name:
                        {{ $evaluationPermissions->first()->employee->first_name . ' ' . $evaluationPermissions->first()->employee->last_name }}
                    </p>
                    <div>
                        <label>Choose Branches and Departments:</label><br>
                        @foreach ($branches as $branch)
                            <label>{{ $branch->name }}</label>
                            <select class="selectpicker" wire:model="selectedDepartments.{{ $branch->id }}" multiple
                                data-live-search="true" style="width: 100% !important;" data-width="100%" multiple
                                data-actions-box="true" multiple title="Choose Department">
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" style="width: 100% !important;"
                                        {{ in_array($department->id, $preSelectedDepartments[$branch->id] ?? []) ? 'selected' : '' }}>
                                        {{ $department->name }}</option>
                                @endforeach
                            </select><br>
                            <div class="rating-scale"></div>
                        @endforeach
                        <button wire:click="updateSelection" class="btn btn-success">Save</button>
                        <a href="{{ route('settings.evalpermEdit', ['id' => $evaluationPermissions->first()->employee_id]) }}"
                            class="btn btn-success">Cancel</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
