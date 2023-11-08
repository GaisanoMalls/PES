<div>
    <div class="m-t-20 m-b-30">
        <div class="employee-details">
            <div class="row">
                <div class="col-md-4">
                    <label for="department">Department</label>
                    <input type="text" class="form-control" id="department" name="department"
                        placeholder="Enter Department/Section" value="{{ $evaluation->employee->department->name }}"
                        readonly>
                </div>

                <div class="col-md-4">
                    <label for="employee_id">Employee ID</label>
                    <input type="text" class="form-control" id="employee_id" name="employee_id"
                        placeholder="Enter Employee ID" value="{{ $evaluation->employee->employee_id }}" readonly>
                </div>

                <div class="col-md-4">
                    <label for="first_name">Employee Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name"
                        placeholder="Enter Employee Name"
                        value="{{ $evaluation->employee->first_name . ' ' . $evaluation->employee->last_name }}"
                        readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="position">Position</label>
                    <input type="text" class="form-control" id="position" name="position"
                        placeholder="Enter Position" value="{{ $evaluation->employee->position }}" readonly>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="covered_period_start">Join Date</label>
                        <input class="form-control" type="date" id="covered_period_start" name="covered_period_start"
                            value="{{ $evaluation->employee->date_hired }}" required readonly>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="date_of_evaluation">Date of Evaluation</label>
                        <input class="form-control" type="date" wire:model="date_of_evaluation"
                            id="date_of_evaluation" name="date_of_evaluation"
                            value="{{ $evaluation->employee->created_at }}" required readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>





    {{-- <h1>Review Evaluation</h1>

    <div class="evaluation-details">
        <p>ID: {{ $evaluation->id }}</p>
        <p>Template Name: {{ $evaluation->evaluationTemplate->name }}</p>


        <p>Employee ID: {{ $evaluation->employee_id }}</p>
        <p>Template ID: {{ $evaluation->evaluation_template_id }}</p>
        <p>Evaluated by:
            {{ $evaluation->evaluatorEmployee->first_name . ' ' . $evaluation->evaluatorEmployee->last_name }}</p>
        {{-- Access related data --}}

    <!-- Add more fields as needed -->
</div>

<!-- Add any additional content or buttons for the review page -->
</div>
