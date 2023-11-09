<div>
    @if ($currentStep === 1)
        <span>Non-Supervisory (Support & Non-Sales)</span>
        <h1>{{ $templateName }}</h1>
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
                                placeholder="Enter Department/Section" value="{{ $departmentName }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="employee_id">Employee ID</label>
                            <input type="text" class="form-control" id="employee_id" name="employee_id"
                                placeholder="Enter Employee ID" value="{{ $this->employeeIdCompany }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="first_name">Employee Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                placeholder="Enter Employee Name" value="{{ $name }}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="position">Position</label>
                            <input type="text" class="form-control" id="position" name="position"
                                placeholder="Enter Position" value="{{ $position }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="covered_period_start">Join Date</label>
                                <input class="form-control" type="date" id="covered_period_start"
                                    name="covered_period_start" value="{{ $date_hired }}" required readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="date_of_evaluation">Date of Evaluation</label>
                                <input class="form-control" type="date" wire:model="date_of_evaluation"
                                    id="date_of_evaluation" name="date_of_evaluation" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white">
                <div>
                    <ul style="list-style: none;">
                        @foreach ($partsWithFactors as $key => $partWithFactors)
                            @if ($key === 0)
                                <li style="list-style: none;">

                                    <h4 class="text-center">{{ $partWithFactors['part']->name }}</h4>

                                    <ul style="list-style: none;">
                                        @foreach ($partWithFactors['factors'] as $key => $factor)
                                            @if ($key < 2)
                                                <li style="list-style: none;">
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
                                                                        <input class="custom-radio" type="radio"
                                                                            name="rating_{{ $factor->id }}"
                                                                            value="{{ $ratingScale->equivalent_points }}"
                                                                            wire:model="selectedValues.{{ $factor->id }}"
                                                                            wire:click="updateSelectedValue({{ $factor->id }}, {{ $ratingScale->equivalent_points }})">
                                                                    </label>
                                                                @endforeach

                                                                <label class="radio-inline">
                                                                    @if ($loop->parent->first && $loop->first)
                                                                        <span>POINTS<br><br>
                                                                    @endif
                                                                    <span id="points-{{ $factor->id }}"
                                                                        class="box">
                                                                        {{ $selectedValues[$factor->id] ?? 0 }}
                                                                    </span>
                                                                </label>

                                                            </div>
                                                            <div class="comment m-t-10">
                                                                <div class="form-group">
                                                                    <label for="">Specific
                                                                        situations/incidents to support
                                                                        rating:</label>
                                                                    <textarea placeholder="Type here..." class="form-control" wire:model="factorNotes.{{ $factor->id }}"
                                                                        wire:change="updateNote({{ $factor->id }}, $event.target.value)"></textarea>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <button wire:click="submitStep1" class="btn btn-primary btn-right">Next Page>></button>
        </form>
    @elseif ($currentStep === 2)
        <form wire:submit.prevent="submitStep2">
            @csrf
            <div class="bg-white">
                <div>
                    <ul style="list-style: none;">
                        @foreach ($partsWithFactors as $partWithFactors)
                            <li style="list-style: none;">
                                <div class="rating-scale">
                                </div>
                                @if ($partWithFactors['part']->id === 2)
                                    <h4 class="text-center">{{ $partWithFactors['part']->name }}</h4>
                                @endif
                                <ul style="list-style: none;">
                                    @foreach ($partWithFactors['factors'] as $factor)
                                        @if ($partWithFactors['part']->id === 1 && $factor->part_id === 1)
                                            @if ($loop->iteration >= 3)
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h5>{{ $factor->name }}</h5>
                                                        <p>{{ $factor->description }}</p>
                                                    </div>
                                                    <div class="col-6 text-center">
                                                        <div class="">
                                                            <label class="radio-inline">
                                                                @if ($loop->parent->first && $loop->first)
                                                                    <span>Allotted%<br><br>
                                                                @endif
                                                                @if ($factor->rating_scales)
                                                                    <span
                                                                        class="box">{{ $factor->rating_scales->first()->equivalent_points }}%</span>
                                                                @endif
                                                            </label>
                                                            @if ($factor->rating_scales)
                                                                @foreach ($factor->rating_scales as $ratingScale)
                                                                    <label class="radio-inline">
                                                                        @if ($loop->parent->first)
                                                                            <span>{{ $ratingScale->acronym }}<br></span>
                                                                        @endif
                                                                        {{ $ratingScale->equivalent_points }}<br>
                                                                        <input class="custom-radio" type="radio"
                                                                            name="rating_{{ $factor->id }}"
                                                                            value="{{ $ratingScale->equivalent_points }}"
                                                                            wire:model="selectedValues.{{ $factor->id }}"
                                                                            wire:click="updateSelectedValue({{ $factor->id }}, {{ $ratingScale->equivalent_points }})"><br>

                                                                    </label>
                                                                @endforeach
                                                            @endif
                                                            <label class="radio-inline">
                                                                @if ($loop->parent->first && $loop->first)
                                                                    <span>POINTS<br><br>
                                                                @endif
                                                                <span id="points-{{ $factor->id }}" class="box">
                                                                    {{ $selectedValues[$factor->id] ?? 0 }}
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="comment m-t-10">
                                                            <div class="form-group">
                                                                <label for="">Specific
                                                                    situations/incidents to support
                                                                    rating:</label>
                                                                <textarea placeholder="Type here..." class="form-control" wire:model="factorNotes.{{ $factor->id }}"
                                                                    wire:change="updateNote({{ $factor->id }}, $event.target.value)"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    @if ($loop->last && $partWithFactors['part']->id === 1)
                                                        <div class="col-6 text-left">
                                                            <h5 hidden>Total Rate (Part 1)</h5>
                                                        </div>
                                                        <div class="col-12 text-center m-t-20">
                                                            <span>Total Rate (Part 1)<br>
                                                                <span class="box">{{ $totalRatePart1 }}</span>
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        @elseif ($partWithFactors['part']->id === 2 && $factor->part_id === 2)
                                            @if ($loop->iteration <= 4)
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h5>{{ $factor->name }}</h5>
                                                        <p>{{ $factor->description }}</p>
                                                    </div>
                                                    <div class="col-6 text-center">
                                                        <div class="">
                                                            <label class="radio-inline">
                                                                @if ($partWithFactors['part']->id === 2 && $factor->part_id === 2 && $loop->first)
                                                                    <span>Allotted%<br><br>
                                                                @endif
                                                                @if ($factor->rating_scales)
                                                                    <span
                                                                        class="box">{{ $factor->rating_scales->first()->equivalent_points }}%</span>
                                                                @endif
                                                            </label>
                                                            @if ($factor->rating_scales)
                                                                @foreach ($factor->rating_scales as $ratingScale)
                                                                    <label class="radio-inline">
                                                                        @if ($loop->parent->first)
                                                                            <span>{{ $ratingScale->acronym }}<br></span>
                                                                        @endif
                                                                        {{ $ratingScale->equivalent_points }}<br>
                                                                        <input class="custom-radio" type="radio"
                                                                            name="rating_{{ $factor->id }}"
                                                                            value="{{ $ratingScale->equivalent_points }}"
                                                                            wire:model="selectedValues.{{ $factor->id }}"
                                                                            wire:click="updateSelectedValue({{ $factor->id }}, {{ $ratingScale->equivalent_points }})">

                                                                    </label>
                                                                @endforeach
                                                            @endif

                                                            <label class="radio-inline">
                                                                @if ($loop->parent->first && $loop->first)
                                                                    <span>POINTS<br><br>
                                                                @endif
                                                                <span id="points-{{ $factor->id }}" class="box">
                                                                    {{ $selectedValues[$factor->id] ?? 0 }}
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="comment m-t-10">
                                                            <div class="form-group">
                                                                <label for="">Specific
                                                                    situations/incidents to support
                                                                    rating:</label>
                                                                <textarea placeholder="Type here..." class="form-control" wire:model="factorNotes.{{ $factor->id }}"
                                                                    wire:change="updateNote({{ $factor->id }}, $event.target.value)"></textarea>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </form>
        <button wire:click="submitStep2" class="btn btn-primary btn-right">Next</button>
        <button wire:click="goBack" class="btn btn-primary btn-left">Back</button>
    @elseif ($currentStep === 3)
        <form wire:submit.prevent="submitStep3">
            @csrf
            <div class="bg-white">
                <div>
                    <ul style="list-style: none;">
                        @foreach ($partsWithFactors as $partWithFactors)
                            <li style="list-style: none;">

                                @if ($partWithFactors['part']->id === 3)
                                    <div class="rating-scale">
                                    </div>
                                    <h4 class="text-center">{{ $partWithFactors['part']->name }}</h4>
                                @endif
                                <ul style="list-style: none;">
                                    @foreach ($partWithFactors['factors'] as $factor)
                                        @if ($partWithFactors['part']->id === 2 && $factor->part_id === 2)
                                            @if ($loop->iteration >= 5)
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h5>{{ $factor->name }}</h5>
                                                        <p>{{ $factor->description }}</p>
                                                    </div>
                                                    <div class="col-6 text-center">
                                                        <div class="">
                                                            <label class="radio-inline">
                                                                @if ($loop->parent->first && $loop->first)
                                                                    <span>Allotted%<br><br>
                                                                @endif
                                                                @if ($factor->rating_scales)
                                                                    <span
                                                                        class="box">{{ $factor->rating_scales->first()->equivalent_points }}%</span>
                                                                @endif
                                                            </label>
                                                            @if ($factor->rating_scales)
                                                                @foreach ($factor->rating_scales as $ratingScale)
                                                                    <label class="radio-inline">
                                                                        @if ($loop->parent->first)
                                                                            <span>{{ $ratingScale->acronym }}<br></span>
                                                                        @endif
                                                                        {{ $ratingScale->equivalent_points }}<br>
                                                                        <input class="custom-radio" type="radio"
                                                                            name="rating_{{ $factor->id }}"
                                                                            value="{{ $ratingScale->equivalent_points }}"
                                                                            wire:model="selectedValues.{{ $factor->id }}"
                                                                            wire:click="updateSelectedValue({{ $factor->id }}, {{ $ratingScale->equivalent_points }})"><br>

                                                                    </label>
                                                                @endforeach
                                                            @endif
                                                            <label class="radio-inline">
                                                                @if ($loop->parent->first && $loop->first)
                                                                    <span>POINTS<br><br>
                                                                @endif
                                                                <span id="points-{{ $factor->id }}" class="box">
                                                                    {{ $selectedValues[$factor->id] ?? 0 }}
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="comment m-t-10">
                                                            <div class="form-group">
                                                                <label for="">Specific
                                                                    situations/incidents to support
                                                                    rating:</label>
                                                                <textarea placeholder="Type here..." class="form-control" wire:model="factorNotes.{{ $factor->id }}"
                                                                    wire:change="updateNote({{ $factor->id }}, $event.target.value)"></textarea>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    @if ($loop->last && $partWithFactors['part']->id === 2)
                                                        <div class="col-6 text-left">
                                                            <h5 hidden>Total Rate (Part 2)</h5>
                                                        </div>
                                                        <div class="col-12 text-center m-t-20">
                                                            <span>Total Rate (Part 2)<br>
                                                                <span class="box">{{ $totalRatePart2 }}</span>
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        @elseif ($partWithFactors['part']->id === 3 && $factor->part_id === 3)
                                            @if ($loop->iteration <= 5)
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h5>{{ $factor->name }}</h5>
                                                        <p>{{ $factor->description }}</p>
                                                    </div>
                                                    <div class="col-6 text-center">
                                                        <div class="">
                                                            <label class="radio-inline">
                                                                @if ($partWithFactors['part']->id === 3 && $factor->part_id === 3 && $loop->first)
                                                                    <span>Allotted%<br><br>
                                                                @endif
                                                                @if ($factor->rating_scales)
                                                                    <span
                                                                        class="box">{{ $factor->rating_scales->first()->equivalent_points }}%</span>
                                                                @endif
                                                            </label>
                                                            @if ($factor->rating_scales)
                                                                @foreach ($factor->rating_scales as $ratingScale)
                                                                    <label class="radio-inline">
                                                                        @if ($loop->parent->first)
                                                                            <span>{{ $ratingScale->acronym }}<br></span>
                                                                        @endif
                                                                        {{ $ratingScale->equivalent_points }}<br>
                                                                        <input class="custom-radio" type="radio"
                                                                            name="rating_{{ $factor->id }}"
                                                                            value="{{ $ratingScale->equivalent_points }}"
                                                                            wire:model="selectedValues.{{ $factor->id }}"
                                                                            wire:click="updateSelectedValue({{ $factor->id }}, {{ $ratingScale->equivalent_points }})">

                                                                    </label>
                                                                @endforeach
                                                            @endif

                                                            <label class="radio-inline">
                                                                @if ($loop->parent->first && $loop->first)
                                                                    <span>POINTS<br><br>
                                                                @endif
                                                                <span id="points-{{ $factor->id }}" class="box">
                                                                    {{ $selectedValues[$factor->id] ?? 0 }}
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="comment m-t-10">
                                                            <div class="form-group">
                                                                <label for="">Specific
                                                                    situations/incidents to support
                                                                    rating:</label>
                                                                <textarea placeholder="Type here..." class="form-control" wire:model="factorNotes.{{ $factor->id }}"
                                                                    wire:change="updateNote({{ $factor->id }}, $event.target.value)"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    @if ($loop->last && $partWithFactors['part']->id === 3)
                                                        <div class="col-6 text-left">
                                                            <h5 hidden>Total Rate (Part 3)</h5>
                                                        </div>
                                                        <div class="col-12 text-center m-t-20">
                                                            <span>Total Rate (Part 3)<br>
                                                                <span class="box">{{ $totalRatePart3 }}</span>
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </form>
        <button wire:click="submitStep3" class="btn btn-primary btn-right">Next</button>
        <button wire:click="goBack" class="btn btn-primary btn-left">Back</button>
    @elseif ($currentStep === 4)
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
                <tr>
                    <td>Part 1 Result area</td>
                    <td>50%</td>
                    <td>{{ $totalRatePart1 }}</td>
                    <td style="text-align: center; vertical-align: middle" rowspan="4">
                        80%
                    </td>
                    <td> <span
                            style="color: {{ $totalRateCombine >= 95 && $totalRateCombine <= 100 ? 'green' : 'default' }};">95-100%
                            Outstanding</span>
                    </td>
                    <td>
                        <span style="color: {{ $totalRateCombine >= 80 ? 'green' : 'red' }};">
                            {{ $totalRateCombine >= 80 ? 'Passed' : 'Failed' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Part 2. Behavior Traits</td>
                    <td>30%</td>
                    <td>{{ $totalRatePart2 }}</td>
                    <td> <span
                            style="color: {{ $totalRateCombine >= 90 && $totalRateCombine < 94 ? 'orange' : 'default' }};">90-94%
                            High Average</span>
                    </td>
                    <td></td>
                </tr>

                <tr>
                    <td>Part 3. Core Values</td>
                    <td>20%</td>
                    <td>{{ $totalRatePart3 }}</td>
                    <td> <span
                            style="color: {{ $totalRateCombine >= 80 && $totalRateCombine < 89 ? 'blue' : 'default' }};">80-89%
                            Average</span>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>100%</td>
                    <td>{{ $totalRateCombine }}</td>
                    <td>
                        <span
                            style="color: {{ $totalRateCombine >= 70 && $totalRateCombine < 80 ? 'yellow' : 'default' }};">70-79%
                            Satisfactory</span>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <span style="color: {{ $totalRateCombine < 69 ? 'red' : 'default' }};">69%
                            & below</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="m-t-10">
            <div class="comment">
                <div class="form-group">
                    <label for="recommendations">RECOMMENDATION:</label>
                    <textarea name="recommendations" id="recommendations" placeholder="Write a message" class="form-control"
                        wire:model="recommendationNote" wire:change="updateComment('recommendations')"></textarea>
                </div>
            </div>
            <div class="comment m-t-10">
                <div class="form-group">
                    <label for="ratee_comments">RATEE’S COMMENTS:</label>
                    <textarea name="ratee_comments" id="ratee_comments" placeholder="Write a message" class="form-control"
                        wire:model="rateesComment" wire:change="updateComment('ratee_comments')"></textarea>
                </div>
            </div>
        </div>
        <button wire:click="goBack" class="btn btn-primary btn-left">Back</button>
        <button wire:click="submitStep4" class="btn btn-primary btn-right">Submit Evaluation</button>
    @endif
</div>
