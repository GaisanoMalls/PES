<!-- evaluation-permission-create.blade.php -->
<div class="m-t-30">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h1>Evaluation Permission</h1>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="evaluator">Select Evaluator:</label>
                            <select class="form-control">
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
                            <label>
                                <input type="checkbox" name="branches[]" value="{{ $branch->id }}">
                                <h4>{{ $branch->name }}</h4>
                            </label><br>
                            @foreach ($departments as $department)
                                <label>
                                    <input type="checkbox" name="departments[]" value="{{ $department->id }}">
                                    {{ $department->name }}
                                </label><br>
                            @endforeach
                            <div class="rating-scale"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
