<!-- Add the required Select2 CSS and JS files -->

<div class="m-t-30">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h1>Evaluation Permission</h1>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="evaluator">Select Evaluator:</label>
                            <select class="form-control" wire:model="selectedEvaluator">
                                <option value="">Select Evaluator</option>
                                @foreach ($evaluators as $evaluator)
                                    <option value="{{ $evaluator->id }}">
                                        {{ $evaluator->employee->first_name . ' ' . $evaluator->employee->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label>Choose Branches and Departments:</label><br>
                        @foreach ($branches as $branch)
                            <label>{{ $branch->name }}</label>
                            <select class="selectpicker" wire:model="selectedDepartments.{{ $branch->id }}" multiple
                                data-live-search="true" style="width: 100% !important;" data-width="100%" multiple
                                data-actions-box="true" multiple title="Choose Department">
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" style="width: 100% !important;">
                                        {{ $department->name }}</option>
                                @endforeach
                            </select><br>
                            <div class="rating-scale"></div>
                        @endforeach
                        <button wire:click="saveSelection" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
