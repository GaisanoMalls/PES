<!-- Add the required Select2 CSS and JS files -->

<div class="m-t-30">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Evaluation Permission</h3>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="evaluator">Select Evaluator:</label>
                            <select class="form-control" wire:model="selectedEvaluator">
                                <option value="">Select Evaluator</option>

                            </select>
                        </div>
                    </div>
                    <div>
                        <label>Choose Branches and Departments:</label><br>
                        @foreach ($branches as $branch)
                            <label>{{ $branch->name }}</label>
                            <select class="selectpicker" wire:model="selectedDepartments.{{ $branch->id }}"
                                data-live-search="true" multiple data-actions-box="true" title="Choose Department">
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">
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
