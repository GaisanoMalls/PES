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
                        @foreach ($partsWithFactors as $partWithFactors)
                            <li style="list-style: none;">
                                @if ($loop->first)
                                    <h4 class="text-center">{{ $partWithFactors['part']->name }}</h4>
                                @endif
                                <ul style="list-style: none;">
                                    @foreach ($partWithFactors['factors'] as $factorData)
                                        <li style="list-style: none">
                                            <ul style="list-style: none;">
                                                <li style="list-style: none">
                                                    <div class="row">
                                                        <div class="col-6 text-left">
                                                            <h5>{{ $factorData['factor']->name }}</h5>
                                                            <p>{{ $factorData['factor']->description }}</p>
                                                        </div>
                                                        <div class="col-6 text-center">
                                                            <div class="">
                                                                <label class="radio-inline">
                                                                    @if ($loop->first)
                                                                        <span>Allotted%<br><br></span>
                                                                    @endif
                                                                    <span
                                                                        class="box">{{ $factorData['rating_scales']->max('equivalent_points') }}%</span>
                                                                </label>
                                                                @foreach ($factorData['rating_scales'] as $ratingScale)
                                                                    <label class="radio-inline">
                                                                        {{ $ratingScale->acronym }}<br>
                                                                        {{ $ratingScale->equivalent_points }}<br>
                                                                        <input disabled class="custom-radio"
                                                                            type="radio"
                                                                            name="rating_{{ $ratingScale->factor_id }}"
                                                                            value="{{ $ratingScale->equivalent_points }}"
                                                                            @if (isset($selectedValues[$ratingScale->factor_id]) &&
                                                                                    $selectedValues[$ratingScale->factor_id] === $ratingScale->equivalent_points) checked @endif>
                                                                    </label>
                                                                @endforeach
                                                                <label class="radio-inline">
                                                                    @if ($loop->parent->first && $loop->first)
                                                                        <span>POINTS<br><br>
                                                                    @endif
                                                                    <span id="points-{{ $factorData['factor']->id }}"
                                                                        class="box">
                                                                        {{ $selectedValues[$factorData['factor']->id] ?? 0 }}
                                                                    </span>
                                                                </label>
                                                            </div>
                                                            <div class="comment m-t-10">
                                                                <div class="form-group">
                                                                    <label for="">Specific
                                                                        situations/incidents
                                                                        to support rating:</label>
                                                                    <textarea class="form-control" readonly>{{ $factorNotes[$factorData['factor']->id] ?? '' }}</textarea> {{-- Display the factor note --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        @if ($loop->last)
                                                            <div class="col-6 text-left">
                                                                <div class="btn-right"></div>
                                                                <h5 hidden>Total Actual Points Rate (Part
                                                                    {{ $partWithFactors['part']->id }})
                                                                </h5>
                                                            </div>
                                                            <div class="col-12 text-center m-t-20">
                                                                <span>Total Rate (Part
                                                                    {{ $partWithFactors['part']->id }})<br>
                                                                    <span
                                                                        class="box">{{ $partWithFactors['totalRate'] }}</span>
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                        @endforeach
                </div>
            </div>
            <button wire:click="submitStep1" class="btn btn-outline-success btn-right">Rating Summary</button>
        </form>
    @elseif ($currentStep === 2)
        <div class="bg-white2 p-20">
            <ul style="list-style: none;">
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
                        @foreach ($partsWithFactors as $index => $partWithFactors)
                            <tr>
                                <td>{{ $partWithFactors['part']->name }}</td>
                                <td>{{ $partWithFactors['part']->criteria_allocation }}%</td>
                                <td>{{ $partWithFactors['totalRate'] }}</td>
                                @if ($loop->first)
                                    <td style="text-align: center; vertical-align: middle" rowspan="4">80%</td>
                                    <td rowspan="5">
                                        <ul>
                                            @foreach ($ratingScales as $scale)
                                                @if ($scale['name'] == 'Outstanding')
                                                    @if ($totalRateForAllParts >= 95)
                                                        <strong> 95-100% {{ $scale['name'] }}</strong>
                                                    @else
                                                        95-100% {{ $scale['name'] }}
                                                    @endif
                                                    <br>
                                                @elseif ($scale['name'] == 'High Average')
                                                    @if ($totalRateForAllParts >= 90 && $totalRateForAllParts <= 94)
                                                        <strong>90-94% {{ $scale['name'] }}</strong>
                                                    @else
                                                        90-94% {{ $scale['name'] }}
                                                    @endif
                                                    <br>
                                                @elseif ($scale['name'] == 'Average')
                                                    @if ($totalRateForAllParts >= 80 && $totalRateForAllParts <= 89)
                                                        <strong>80-89% {{ $scale['name'] }}</strong>
                                                    @else
                                                        80-89% {{ $scale['name'] }}
                                                    @endif
                                                    <br>
                                                @elseif ($scale['name'] == 'Satisfactory')
                                                    @if ($totalRateForAllParts >= 70 && $totalRateForAllParts <= 79)
                                                        <strong>70-79% {{ $scale['name'] }}</strong>
                                                    @else
                                                        70-79% {{ $scale['name'] }}
                                                    @endif
                                                    <br>
                                                @elseif ($scale['name'] == 'Poor')
                                                    @if ($totalRateForAllParts <= 69)
                                                        <strong> 69% & below {{ $scale['name'] }}</strong>
                                                    @else
                                                        69% & below {{ $scale['name'] }}
                                                    @endif
                                        </ul>
                                @endif
                        @endforeach
            </ul>
            </td>
    @endif
    <td>
        @if ($loop->iteration == 1)
            @if ($totalRateForAllParts >= 80)
                <a class="btn btn-sm bg-success-light mr-2">Passed</a>
            @else
                Passed
            @endif
        @elseif ($loop->iteration == 2)
            @if ($totalRateForAllParts < 80)
                <a class="btn btn-sm bg-danger-light mr-2">Failed</a>
            @else
                Failed
            @endif
        @endif
    </td>
    </tr>
    @endforeach


    </tr>

    <tr>
        <td>Total</td>
        <td>100%</td>
        <td>{{ $totalRateForAllParts }}</td>
        <td></td>
        <td></td>
    </tr>
    </tbody>
    </table>

    <div class="m-t-50">
        <div class="comment">
            <div class="form-group">
                <label for="recommendations">RECOMMENDATION:</label>
                <textarea name="recommendations" id="recommendations" placeholder="Write a message" class="form-control" readonly>{{ $evaluation->recommendation_note }}</textarea>
            </div>
        </div>

        <div class="comment m-t-10">
            <div class="form-group">
                <label for="ratee_comments">RATEE’S COMMENTS:</label>
                <textarea name="ratee_comments" id="ratee_comments" placeholder="Write a message" class="form-control" readonly>{{ $evaluation->ratees_comment }}</textarea>
            </div>
        </div>

    </div>
    <a href="{{ route('evaluations.review', ['evaluation' => $evaluation->id]) }}"><button
            class="btn btn-outline-success">Back</button></a>


    <button wire:click="approveEvaluation"
        @if ($evaluation->status == 2) class="btn btn-outline-secondary btn-right" disabled @else  class="btn btn-outline-success btn-right" @endif>Approve
        Evaluation</button>

    <button data-toggle="modal" data-target="#disapproveModal"
        @if ($evaluation->status == 3) class="btn btn-outline-secondary btn-right" disabled @else  class="btn btn-outline-danger btn-right" @endif>Disapprove
        Evaluation</button>

    @endif

    <!-- Modal -->
    <div class="modal fade" id="disapproveModal" tabindex="-1" role="dialog"
        aria-labelledby="disapproveModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="disapproveModalLabel">Disapprove Evaluation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea wire:model="disapprovalDescription" id="description" placeholder="Please state the reason for disapproval"
                            class="form-control"></textarea>
                        @error('disapprovalDescription')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <button wire:click="disapproveEvaluation"
                        @if ($evaluation->status == 3) class="btn btn-outline-secondary btn-right" disabled @else  class="btn btn-outline-danger btn-right" @endif>Disapprove
                        Evaluation</button>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Add any additional content or buttons for the review page -->
</div>