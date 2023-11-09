<div>
    @if ($currentStep === 1)
        <span>Non-Supervisory (Support & Non-Sales)</span>
        <h1>{{ $evaluation->evaluationTemplate->name }}</h1>
        {{-- <span>Template ID: {{ $templateId }}</span>
        <span>Employee ID: {{ $employeeId }} </span> --}}

        <form wire:submit.prevent="submitStep1">
            @csrf
            <div class="m-t-20 m-b-30">
                <div class="employee-details">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="department">Department</label>
                            <input type="text" class="form-control" id="department" name="department"
                                placeholder="Enter Department/Section"
                                value="{{ $evaluation->employee->department->name }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="employee_id">Employee ID</label>
                            <input type="text" class="form-control" id="employee_id" name="employee_id"
                                placeholder="Enter Employee ID" value="{{ $evaluation->employee->employee_id }}"
                                readonly>
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
                                <input class="form-control" type="date" id="covered_period_start"
                                    name="covered_period_start" value="{{ $evaluation->employee->date_hired }}" required
                                    readonly>
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
            <div class="bg-white2">
                <div>
                    <ul style="list-style: none;">
                        @foreach ($partsWithFactors as $key => $partWithFactors)
                            {{-- @if ($key === 1) --}}
                            <li style="list-style: none">
                                <div class="rating-scale">
                                </div>
                                <h4 class="text-center m-t-50">{{ $partWithFactors['part']->name }}</h4>
                                <ul style="list-style: none;">
                                    @foreach ($partWithFactors['factors'] as $key => $factor)
                                        <li style="list-style: none">
                                            <div class="row">
                                                <div class="col-6 text-left">
                                                    <h5>{{ $factor->name }}</h5>
                                                    <p>{{ $factor->description }}</p>
                                                </div>
                                                <div class="col-6 text-center">
                                                    <div class="">
                                                        <label class="radio-inline">
                                                            @if ($loop->parent->first && $loop->first)
                                                                <span>Allotted%<br><br></span>
                                                            @endif
                                                            <span
                                                                class="box">{{ $factor->rating_scales->first()->equivalent_points }}%</span>
                                                        </label>

                                                        @foreach ($factor->rating_scales as $ratingScale)
                                                            <label class="radio-inline">
                                                                @if ($loop->parent->first)
                                                                    <span>{{ $ratingScale->acronym }}<br></span>
                                                                @endif
                                                                {{ $ratingScale->equivalent_points }}<br>

                                                                {{-- <input disabled class="custom-radio" type="radio"
                                                                        name="rating_{{ $ratingScale->factor_id }}"
                                                                        value="{{ $ratingScale->equivalent_points }}"
                                                                        @if (isset($selectedValues[$ratingScale->factor_id]) && $selectedValues[$ratingScale->factor_id] === $ratingScale->equivalent_points) checked @endif> --}}

                                                            </label>
                                                        @endforeach

                                                        <label class="radio-inline">
                                                            @if ($loop->parent->first && $loop->first)
                                                                <span>POINTS<br><br>
                                                            @endif
                                                            Points
                                                            <span id="points-{{ $factor->id }}" class="box">
                                                                <strong>
                                                                    {{ $selectedValues[$factor->id] ?? 0 }}</strong>
                                                                {{-- Display the selected value --}}
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="comment m-t-10">
                                                        <div class="form-group">
                                                            <label for="">Specific situations/incidents
                                                                to support rating:</label>
                                                            <textarea class="form-control" readonly>{{ $factorNotes[$factor->id] ?? '' }}</textarea> {{-- Display the factor note --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                @if ($loop->last)
                                                    <div class="col-6 text-left">
                                                        <h5 hidden>Total Rate (Part {{ $partWithFactors['part']->id }})
                                                        </h5>
                                                    </div>
                                                    <div class="col-12 text-center m-t-20">
                                                        <span>Total Rate (Part {{ $partWithFactors['part']->id }})<br>
                                                            <span
                                                                class="box">{{ $partWithFactors['part']->totalRate }}</span>
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            {{-- @endif --}}
                        @endforeach
                    </ul>
                </div>
            </div>
            <button wire:click="submitStep1" class="btn btn-primary btn-right">Rating Summary</button>
        </form>
    @elseif ($currentStep === 2)
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>Performance Measurement</th>
                    <th>Criteria</th>
                    <th>Total Actual Points/Rate</th>
                    <th>Passing Points/Rate</th>
                    <th>Ratee's Performance Level</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($partsWithFactors as $partWithFactors)
                    <tr>
                        <td>{{ $partWithFactors['part']->name }}</td>
                        <td>{{ $partWithFactors['part']->criteria_allocation }}%</td>
                        <td>{{ $totalRates[$partWithFactors['part']->id] }}</td>

                        <td>
                        </td>

                        <td></td>
                        <td></td>
                    </tr>
                @endforeach


                <tr>
                    <td>Total</td>
                    <td>100%</td>
                    <td>{{ $combinedTotalRate }}</td>
                    <td></td>
                    <td>
                    </td>
                </tr>
            </tbody>
        </table>


    @endif

    <!-- Add any additional content or buttons for the review page -->
</div>
