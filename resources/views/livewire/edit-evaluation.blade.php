<div>

    <div class="container22">

        @if ($evaluation->status === 2)
            <a href="#" class="btn btn-lg bg-success-light mb-2" style="cursor: default;">Approved
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                    class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                    <polyline points="22 4 12 14.01 9 11.01" />
                </svg>

            </a>
        @elseif ($evaluation->status === 3)
            <a href="#" class="btn btn-lg bg-danger-light mb-2" style="cursor: default;">Disapproved
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                    class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="15" x2="9" y1="9" y2="15" />
                    <line x1="9" x2="15" y1="9" y2="15" />
                </svg>

            </a>
            <a data-toggle="modal" data-target="#disapproveModal" class="" style="cursor: pointer;">
                View Reason of Disapproval
            </a>
        @elseif ($evaluation->status === 4)
            <a href="#" class="btn btn-lg bg-warning-light mb-2" style="cursor: default;">Clarifcations
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                    class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" x2="12" y1="8" y2="12" />
                    <line x1="12" x2="12.01" y1="16" y2="16" />
                </svg>
            </a>
            @if ($evaluation->evaluator_id == Auth::user()->employee_id)
                <button wire:click="toggleEditMode" class="btn btn-outline-success mb-2">
                    {{ $this->getModeButtonText() }}
                </button>
            @endif
        @else
            @if ($evaluation->evaluator_id == Auth::user()->employee_id)
                <button wire:click="toggleEditMode" class="btn btn-outline-success mb-2">
                    {{ $this->getModeButtonText() }}
                </button>
            @endif
        @endif


    </div>


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
                                    name="covered_period_start" value="{{ $evaluation->employee->date_hired }}"
                                    required readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="created_at">Date of Evaluation</label>
                                <input class="form-control" type="text" id="created_at" name="created_at"
                                    value="{{ $evaluation->created_at }}" required readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white2">
                <div>
                    <ul style="list-style: none;">
                        <span>Direction: Rate the following factors by checking the appropriate box which
                            indicates the most accurate appraisal of the ratee’s performance on the job.
                            The rating scale are outlined below:
                        </span>
                        @foreach ($ratingScales as $scale)
                            <div class="rating-scale-item">

                                <strong> <span class="rating-scale-acronym">{{ $scale->acronym }}=</span>
                                    <span class="rating-scale-name"> {{ $scale->name }}:</span></strong>
                                <span class="rating-scale-description">{{ $scale->description }}</span>
                            </div>
                        @endforeach
                        @foreach ($partsWithFactors as $partWithFactors)
                            <li style="list-style: none;">
                                <div class="rating-scale"></div>
                                <h4 class="text-center">{{ $partWithFactors['part']->name }}</h4>

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

                                                                        @if ($editMode)
                                                                            <input
                                                                                wire:click="updateSelectedValue({{ $ratingScale->factor_id }}, {{ $ratingScale->equivalent_points }})"
                                                                                wire:click="updateSelectedScale({{ $ratingScale->factor_id }}, {{ $ratingScale->equivalent_points }})"
                                                                                class="custom-radio" type="radio"
                                                                                name="rating_{{ $ratingScale->factor_id }}"
                                                                                value="{{ $ratingScale->equivalent_points }}"
                                                                                @if (isset($originalValues[$ratingScale->factor_id]) &&
                                                                                        $originalValues[$ratingScale->factor_id] === $ratingScale->equivalent_points) checked @endif>
                                                                        @else
                                                                        @endif
                                                                    </label>
                                                                @endforeach

                                                                @if ($editMode)
                                                                    <br>

                                                                    <label class="radio-inline">
                                                                        @if ($loop->parent->first && $loop->first)
                                                                            <span>OLD POINT<br><br>
                                                                        @endif
                                                                        <span
                                                                            id="old-points-{{ $factorData['factor']->id }}"
                                                                            class="box">
                                                                            {{ $originalValues[$factorData['factor']->id] ?? 0 }}
                                                                        </span>
                                                                    </label>


                                                                    <label class="radio-inline">
                                                                        @if ($loop->parent->first && $loop->first)
                                                                            <span>NEW POINT<br><br>
                                                                        @endif
                                                                        <span
                                                                            id="new-points-{{ $factorData['factor']->id }}"
                                                                            class="box">
                                                                            {{ $selectedValues[$factorData['factor']->id] ?? 0 }}
                                                                        </span>
                                                                    </label>
                                                                @else
                                                                    <label class="radio-inline">
                                                                        @if ($loop->parent->first && $loop->first)
                                                                            <span>POINTS<br><br>
                                                                        @endif
                                                                        <span
                                                                            id="old-points-{{ $factorData['factor']->id }}"
                                                                            class="box">
                                                                            {{ $originalValues[$factorData['factor']->id] ?? 0 }}
                                                                        </span>
                                                                    </label>
                                                                @endif
                                                            </div>


                                                            <div class="comment m-t-10">
                                                                <div class="form-group">
                                                                    <label for="">Specific situations/incidents
                                                                        to support rating:</label>
                                                                    <textarea class="form-control" placeholder="{{ $originalNotes[$factorData['factor']->id] ?? '' }}"
                                                                        wire:model="factorNotes.{{ $factorData['factor']->id }}" @if (!$editMode) disabled @endif>{{ $factorNotes[$factorData['factor']->id] ?? '' }}
                                                                    </textarea>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>


                                                    @if ($loop->last)
                                                        <div class="c m-t-5 m-r-15">
                                                            <strong>
                                                                <span>Total Actual Points/Rate =
                                                                    {{-- {{ $partWithFactors['part']->name }} - Total Rate: --}}
                                                                    <span class="box">
                                                                        {{ $partWithFactors['totalRate'] }}</span>
                                                                </span>
                                                            </strong>
                                                        </div>
                                                    @endif

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

                                        @foreach ($ratingScales as $scale)
                                            @if ($scale['name'] == 'Outstanding')
                                                @if ($totalRateForAllParts >= 95)
                                                    <strong style="color: #39BF26;"> 95-100%
                                                        {{ $scale['name'] }}</strong>
                                                @else
                                                    95-100% {{ $scale['name'] }}
                                                @endif
                                                <br>
                                            @elseif ($scale['name'] == 'High Average')
                                                @if ($totalRateForAllParts >= 90 && $totalRateForAllParts <= 94)
                                                    <strong style="color: #268EBF;">90-94%
                                                        {{ $scale['name'] }}</strong>
                                                @else
                                                    90-94% {{ $scale['name'] }}
                                                @endif
                                                <br>
                                            @elseif ($scale['name'] == 'Average')
                                                @if ($totalRateForAllParts >= 80 && $totalRateForAllParts <= 89)
                                                    <strong style="color: #B3BF26;">80-89%
                                                        {{ $scale['name'] }}</strong>
                                                @else
                                                    80-89% {{ $scale['name'] }}
                                                @endif
                                                <br>
                                            @elseif ($scale['name'] == 'Satisfactory')
                                                @if ($totalRateForAllParts >= 70 && $totalRateForAllParts <= 79)
                                                    <strong style="color: #BF6226;">70-79%
                                                        {{ $scale['name'] }}</strong>
                                                @else
                                                    70-79% {{ $scale['name'] }}
                                                @endif
                                                <br>
                                            @elseif ($scale['name'] == 'Poor')
                                                @if ($totalRateForAllParts <= 69)
                                                    <strong style="color: #BF3426;">69% & below
                                                        {{ $scale['name'] }}</strong>
                                                @else
                                                    69% & below {{ $scale['name'] }}
                                                @endif
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
                <textarea class="form-control" wire:model="recommendationNote" placeholder="{{ $evaluation->recommendation_note }}"
                    @if (!$editMode) disabled @endif></textarea>
            </div>
        </div>

        <div class="comment m-t-10">
            <div class="form-group">
                <label for="ratee_comments">RATEE’S COMMENTS:</label>
                <textarea class="form-control" wire:model="rateesComment" placeholder="{{ $evaluation->ratees_comment }}"
                    @if (!$editMode) disabled @endif></textarea>
            </div>
        </div>
    </div>
    @if ($evaluation->recommendation)
        <div class="m-t-30">
            <h4 class="text-center">Recommendation</h4>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="current_salary">Current Salary:</label>
                        <input type="number" class="form-control" wire:model="currentSalary"
                            wire:change="calculatePercentageIncrease"
                            placeholder="{{ $evaluation->recommendation->current_salary ?? '' }}"
                            @if (!$editMode) disabled @endif>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="recommended_position">Recommended Position:</label>
                        <input type="text" class="form-control" wire:model="recommendedPosition"
                            placeholder="{{ $evaluation->recommendation->recommended_position ?? '' }}"
                            @if (!$editMode) disabled @endif>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="level">Level:</label>
                        <input type="text" class="form-control" wire:model="level"
                            placeholder="{{ $evaluation->recommendation->level ?? '' }}"
                            @if (!$editMode) disabled @endif>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="recommended_salary">Recommended Salary:</label>
                        <input type="number" class="form-control" wire:model="recommendedSalary"
                            wire:change="calculatePercentageIncrease"
                            placeholder="{{ $evaluation->recommendation->recommended_salary ?? '' }}"
                            @if (!$editMode) disabled @endif>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="recommended_salary">Percentage Increase:</label>
                        <input type="number" class="form-control"
                            placeholder="{{ $evaluation->recommendation->percentage_increase }}" readonly disabled
                            wire:model="percentageIncrease">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        @php
                            $effectivity = optional($evaluation->recommendation)->effectivity;
                        @endphp
                        <label for="effectivityTimestamp">Effectivity Timestamp:
                            {{ $effectivity ? \Carbon\Carbon::parse($effectivity)->format('F d, Y H:i A') : '' }}
                        </label>
                        <input type="datetime-local" class="form-control" wire:model="effectivityTimestamp"
                            @if (!$editMode) disabled @endif>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="remarks">Remarks:</label>
                        <textarea name="remarks" id="remarks" class="form-control" wire:model="remarks"
                            placeholder="{{ $evaluation->recommendation->remarks ?? '' }}" @if (!$editMode) disabled @endif></textarea>
                    </div>
                </div>
            </div>
        </div>
    @endif




    @if ($showClarificationSection)
        <div class="m-t-30">
            @if ($clarifications->count() > 0)
                @foreach ($clarifications as $clarification)
                    <div class="widget author-widget">
                        <span class="blog-author-name">{{ $clarification->commentorName->first_name }}
                            {{ $clarification->commentorName->last_name }} -
                            {{ $clarification->commentor->role->name }}</span>
                        <span class="span-left">{{ $clarification->created_at->diffForHumans() }}</span>
                        <div class="about-author">
                            <div class="author-details">
                                {{-- Editing mode --}}
                                @if ($editingClarificationId === $clarification->id)
                                    <textarea wire:model="clarificationDescription" class="form-control" placeholder="Write your clarifications.."></textarea>
                                    <a href="#"
                                        wire:click.prevent="submitClarification({{ $clarification->id }})">Update</a>
                                    <a href="#" wire:click.prevent="cancelEdit">Cancel</a>
                                @else
                                    {{-- Display mode --}}
                                    <p>
                                        {{ $clarification->description }}</p>
                                    {{-- Check if authenticated user's employee_id is equal to clarification's commentor_id --}}
                                    @auth
                                        @if (auth()->user()->employee_id == $clarification->commentor_id)
                                            {{-- Add your delete button here --}}
                                            <a href="#"
                                                wire:click.prevent="deleteClarification({{ $clarification->id }})"
                                                class="span-ED">Delete</a>
                                            {{-- Change the link based on whether in editing mode or not --}}
                                            @if ($editingClarificationId === $clarification->id)
                                                <a href="#" wire:click.prevent="cancelEdit"
                                                    class="span-ED">Cancel</a>
                                            @else
                                                <a href="#"
                                                    wire:click.prevent="editClarification({{ $clarification->id }})"
                                                    class="span-ED">Update</a>
                                            @endif
                                        @endif
                                    @endauth
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No clarifications available.</p>
            @endif


            <div class="form-group">
                @if ($editingClarificationId)
                @else
                    <label for="description">Description:</label>
                    <textarea rows="3" @if (!$editingClarificationId) wire:model="clarificationDescription" @endif
                        id="description" class="form-control" placeholder="Write your clarifications.."></textarea>
                    <div class="m-t-15">
                        <button wire:click="submitClarification" class="btn btn-outline-success btn-center">Submit
                            Clarification</button>
                    </div>
                @endif

            </div>

    @endif



    <a href="{{ route('evaluations.edit', ['evaluation' => $evaluation->id]) }}"><button
            class="btn btn-outline-success">Back</button></a>

    @if ($evaluation->status === 2 || $evaluation->status === 3 || !$editMode)
    @else
        <button wire:click="updateEvaluation" class="btn btn-outline-success btn-right">Update
            Evaluation</button>
    @endif

    <button wire:click="displayClarificationSection" class="btn btn-outline-secondary btn-right m-r-5 ">View
        Clarifications</button>





    @endif

    <!-- Add any additional content or buttons for the review page -->
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
                        <span>Disapproved by {{ $approverFirstName }}:</span>
                        <textarea id="description" class="form-control" disabled>{{ $disapprovalReason ? $disapprovalReason->description : '' }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
