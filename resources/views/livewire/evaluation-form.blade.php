<div>
    @if ($currentStep === 1)

        <span>Non-Supervisory (Support & Non-Sales)</span>
        <h1>{{ $templateName }}</h1>
        <form wire:submit.prevent="submitStep1">
            @csrf

            <div class="bg-white">
                <div>
                    <ul style="list-style: none;">
                        @foreach ($partsWithFactors as $partWithFactors)
                            @if ($loop->first)
                                <li style="list-style: none;">
                                    @if ($loop->first)
                                        <h4 class="text-center">{{ $partWithFactors['part']->name }}</h4>
                                    @endif
                                    <ul style="list-style: none;">
                                        @foreach ($partWithFactors['factors'] as $factorData)
                                            @if ($loop->index < 2)
                                                <!-- Display only the first two factors -->
                                                <li style="list-style: none;">
                                                    <div class="row">
                                                        <div class="col-6 text-left">
                                                            <h5>{{ $factorData['factor']->name }}</h5>
                                                            <p>{{ $factorData['factor']->description }}</p>
                                                        </div>
                                                        <div class="col-6 text-center">
                                                            <div class="">
                                                                <label class="radio-inline">
                                                                    @if ($loop->first)
                                                                        <span>Allotted<br><br></span>
                                                                    @endif
                                                                    <span
                                                                        class="box">{{ $factorData['rating_scales']->max('equivalent_points') }}%</span>
                                                                </label>

                                                                @foreach ($factorData['rating_scales'] as $ratingScale)
                                                                    <label class="radio-inline">
                                                                        <!-- Display rating scale and its equivalent points -->
                                                                        {{ $ratingScale->acronym }}<br>
                                                                        {{ $ratingScale->equivalent_points }}<br>

                                                                        <!-- Radio button for each rating scale -->
                                                                        <input class="custom-radio" type="radio"
                                                                            name="rating_scale_id_{{ $factorData['factor']->id }}"
                                                                            value="{{ $ratingScale->equivalent_points }}"
                                                                            wire:model="selectedValues.{{ $factorData['factor']->id }}"
                                                                            wire:click="updateSelectedValue({{ $factorData['factor']->id }}, {{ $ratingScale->equivalent_points }})">

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
                                                                    <label for="">Specific situations/incidents
                                                                        to
                                                                        support rating:</label>
                                                                    <textarea placeholder="Type here..." class="form-control" wire:model="factorNotes.{{ $factorData['factor']->id }}"
                                                                        wire:change="updateNote({{ $factorData['factor']->id }}, $event.target.value)"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    @if ($loop->last)
                                        <div class="c m-t-20 m-r-15">
                                            <strong>
                                                <span>Total Actual Points/Rate =
                                                    {{-- {{ $partWithFactors['part']->name }} - Total Rate: --}}
                                                    <span class="box">
                                                        {{ $totalRates[$partWithFactors['part']->id] }}</span>
                                                </span>
                                            </strong>
                                        </div>
                                    @endif
                                    <div class="m-b-30 p-20"></div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>

            <button wire:click="submitStep1" class="btn btn-primary btn-right">Next Page>></button>
        </form>
    @elseif ($currentStep === 2)
        <div class="bg-white">
            @foreach ($partsWithFactors as $partWithFactors)
                @if ($loop->first)
                    <li style="list-style: none;">
                        @if (!$loop->first)
                            <h4 class="text-center">{{ $partWithFactors['part']->name }}</h4>
                        @endif
                        <ul style="list-style: none;">
                            @foreach ($partWithFactors['factors'] as $factorData)
                                @if ($loop->index >= 2)
                                    <!-- Display only the first two factors -->
                                    <li style="list-style: none;">
                                        <div class="row">
                                            <div class="col-6 text-left">
                                                <h5>{{ $factorData['factor']->name }}</h5>
                                                <p>{{ $factorData['factor']->description }}</p>
                                            </div>
                                            <div class="col-6 text-center">
                                                <div class="">
                                                    <label class="radio-inline">
                                                        @if ($loop->first)
                                                            <span>Allotted<br><br></span>
                                                        @endif
                                                        <span
                                                            class="box">{{ $factorData['rating_scales']->max('equivalent_points') }}%</span>
                                                    </label>

                                                    @foreach ($factorData['rating_scales'] as $ratingScale)
                                                        <label class="radio-inline">
                                                            <!-- Display rating scale and its equivalent points -->
                                                            {{ $ratingScale->acronym }}<br>
                                                            {{ $ratingScale->equivalent_points }}<br>

                                                            <!-- Radio button for each rating scale -->
                                                            <input class="custom-radio" type="radio"
                                                                name="rating_scale_id_{{ $factorData['factor']->id }}"
                                                                value="{{ $ratingScale->equivalent_points }}"
                                                                wire:model="selectedValues.{{ $factorData['factor']->id }}"
                                                                wire:click="updateSelectedValue({{ $factorData['factor']->id }}, {{ $ratingScale->equivalent_points }})">

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
                                                        <label for="">Specific situations/incidents
                                                            to
                                                            support rating:</label>
                                                        <textarea placeholder="Type here..." class="form-control" wire:model="factorNotes.{{ $factorData['factor']->id }}"
                                                            wire:change="updateNote({{ $factorData['factor']->id }}, $event.target.value)"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @if ($loop->last)
                                        <div class="c m-t-20 m-r-15">
                                            <strong>
                                                <span>Total Actual Points/Rate =
                                                    {{-- {{ $partWithFactors['part']->name }} - Total Rate: --}}
                                                    <span class="box">
                                                        {{ $totalRates[$partWithFactors['part']->id] }}</span>
                                                </span>
                                            </strong>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                        <div class="m-b-30 p-20"></div>
                    </li>
                @elseif ($loop->index === 1)
                    <div class="rating-scale">
                    </div>
                    <li style="list-style: none;">
                        <h4 class="text-center">{{ $partWithFactors['part']->name }}</h4>
                        <ul style="list-style: none;">
                            @foreach ($partWithFactors['factors'] as $factorData)
                                @if ($loop->index <= 3)
                                    <!-- Display only the first two factors -->
                                    <li style="list-style: none;">
                                        <div class="row">
                                            <div class="col-6 text-left">
                                                <h5>{{ $factorData['factor']->name }}</h5>
                                                <p>{{ $factorData['factor']->description }}</p>
                                            </div>
                                            <div class="col-6 text-center">
                                                <div class="">
                                                    <label class="radio-inline">
                                                        @if ($loop->first)
                                                            <span>Allotted<br><br></span>
                                                        @endif
                                                        <span
                                                            class="box">{{ $factorData['rating_scales']->max('equivalent_points') }}%</span>
                                                    </label>

                                                    @foreach ($factorData['rating_scales'] as $ratingScale)
                                                        <label class="radio-inline">
                                                            <!-- Display rating scale and its equivalent points -->
                                                            {{ $ratingScale->acronym }}<br>
                                                            {{ $ratingScale->equivalent_points }}<br>

                                                            <!-- Radio button for each rating scale -->
                                                            <input class="custom-radio" type="radio"
                                                                name="rating_scale_id_{{ $factorData['factor']->id }}"
                                                                value="{{ $ratingScale->equivalent_points }}"
                                                                wire:model="selectedValues.{{ $factorData['factor']->id }}"
                                                                wire:click="updateSelectedValue({{ $factorData['factor']->id }}, {{ $ratingScale->equivalent_points }})">

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
                                                        <label for="">Specific situations/incidents
                                                            to
                                                            support rating:</label>
                                                        <textarea placeholder="Type here..." class="form-control" wire:model="factorNotes.{{ $factorData['factor']->id }}"
                                                            wire:change="updateNote({{ $factorData['factor']->id }}, $event.target.value)"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @if ($loop->last)
                                        <div class="c m-t-20 m-r-15">
                                            <strong>
                                                <span>Total Actual Points/Rate =
                                                    {{-- {{ $partWithFactors['part']->name }} - Total Rate: --}}
                                                    <span class="box">
                                                        {{ $totalRates[$partWithFactors['part']->id] }}</span>
                                                </span>
                                            </strong>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                        <div class="m-b-30 p-20"></div>
                    </li>
                @endif
            @endforeach
        </div>
        {{-- DISPLAY THE OTHER PARTS AND FACTORS --}}
        <button wire:click="submitStep2" class="btn btn-primary btn-right">Next</button>
        <button wire:click="goBack" class="btn btn-primary btn-left">Back</button>
    @elseif ($currentStep === 3)
        <div class="bg-white">
            @foreach ($partsWithFactors as $partWithFactors)
                @if ($loop->index === 1)
                    @if ($loop->first)
                        <div class="rating-scale">
                        </div>
                        <li style="list-style: none;">
                            <h4 class="text-center">{{ $partWithFactors['part']->name }}</h4>
                    @endif
                    <ul style="list-style: none;">
                        @foreach ($partWithFactors['factors'] as $factorData)
                            @if ($loop->index > 3)
                                <!-- Display only the first two factors -->
                                <li style="list-style: none;">
                                    <div class="row">
                                        <div class="col-6 text-left">
                                            <h5>{{ $factorData['factor']->name }}</h5>
                                            <p>{{ $factorData['factor']->description }}</p>
                                        </div>
                                        <div class="col-6 text-center">
                                            <div class="">
                                                <label class="radio-inline">
                                                    @if ($loop->first)
                                                        <span>Allotted<br><br></span>
                                                    @endif
                                                    <span
                                                        class="box">{{ $factorData['rating_scales']->max('equivalent_points') }}%</span>
                                                </label>

                                                @foreach ($factorData['rating_scales'] as $ratingScale)
                                                    <label class="radio-inline">
                                                        <!-- Display rating scale and its equivalent points -->
                                                        {{ $ratingScale->acronym }}<br>
                                                        {{ $ratingScale->equivalent_points }}<br>

                                                        <!-- Radio button for each rating scale -->
                                                        <input class="custom-radio" type="radio"
                                                            name="rating_scale_id_{{ $factorData['factor']->id }}"
                                                            value="{{ $ratingScale->equivalent_points }}"
                                                            wire:model="selectedValues.{{ $factorData['factor']->id }}"
                                                            wire:click="updateSelectedValue({{ $factorData['factor']->id }}, {{ $ratingScale->equivalent_points }})">

                                                    </label>
                                                @endforeach

                                                <label class="radio-inline">
                                                    @if ($loop->parent->first && $loop->first)
                                                        <span>POINTS<br><br>
                                                    @endif
                                                    <span id="points-{{ $factorData['factor']->id }}" class="box">
                                                        {{ $selectedValues[$factorData['factor']->id] ?? 0 }}
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="comment m-t-10">
                                                <div class="form-group">
                                                    <label for="">Specific situations/incidents
                                                        to
                                                        support rating:</label>
                                                    <textarea placeholder="Type here..." class="form-control" wire:model="factorNotes.{{ $factorData['factor']->id }}"
                                                        wire:change="updateNote({{ $factorData['factor']->id }}, $event.target.value)"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @if ($loop->last)
                                    <div class="c m-t-20 m-r-15">
                                        <strong>
                                            <span>Total Actual Points/Rate =
                                                {{-- {{ $partWithFactors['part']->name }} - Total Rate: --}}
                                                <span class="box">
                                                    {{ $totalRates[$partWithFactors['part']->id] }}</span>
                                            </span>
                                        </strong>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </ul>
                    <div class="m-b-30 p-20"></div>
                    </li>
                @elseif($loop->index === 2)
                    @if (!$loop->first)
                        <div class="rating-scale">
                        </div>
                        <li style="list-style: none;">
                            <h4 class="text-center">{{ $partWithFactors['part']->name }}</h4>
                    @endif
                    <ul style="list-style: none;">
                        @foreach ($partWithFactors['factors'] as $factorData)
                            @if ($loop->index < 5)
                                <!-- Display only the first two factors -->
                                <li style="list-style: none;">
                                    <div class="row">
                                        <div class="col-6 text-left">
                                            <h5>{{ $factorData['factor']->name }}</h5>
                                            <p>{{ $factorData['factor']->description }}</p>
                                        </div>
                                        <div class="col-6 text-center">
                                            <div class="">
                                                <label class="radio-inline">
                                                    @if ($loop->first)
                                                        <span>Allotted<br><br></span>
                                                    @endif
                                                    <span
                                                        class="box">{{ $factorData['rating_scales']->max('equivalent_points') }}%</span>
                                                </label>

                                                @foreach ($factorData['rating_scales'] as $ratingScale)
                                                    <label class="radio-inline">
                                                        <!-- Display rating scale and its equivalent points -->
                                                        {{ $ratingScale->acronym }}<br>
                                                        {{ $ratingScale->equivalent_points }}<br>

                                                        <!-- Radio button for each rating scale -->
                                                        <input class="custom-radio" type="radio"
                                                            name="rating_scale_id_{{ $factorData['factor']->id }}"
                                                            value="{{ $ratingScale->equivalent_points }}"
                                                            wire:model="selectedValues.{{ $factorData['factor']->id }}"
                                                            wire:click="updateSelectedValue({{ $factorData['factor']->id }}, {{ $ratingScale->equivalent_points }})">

                                                    </label>
                                                @endforeach

                                                <label class="radio-inline">
                                                    @if ($loop->parent->first && $loop->first)
                                                        <span>POINTS<br><br>
                                                    @endif
                                                    <span id="points-{{ $factorData['factor']->id }}" class="box">
                                                        {{ $selectedValues[$factorData['factor']->id] ?? 0 }}
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="comment m-t-10">
                                                <div class="form-group">
                                                    <label for="">Specific situations/incidents
                                                        to
                                                        support rating:</label>
                                                    <textarea placeholder="Type here..." class="form-control" wire:model="factorNotes.{{ $factorData['factor']->id }}"
                                                        wire:change="updateNote({{ $factorData['factor']->id }}, $event.target.value)"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @if ($loop->last)
                                    <div class="c m-t-20 m-r-15">
                                        <strong>
                                            <span>Total Actual Points/Rate =
                                                {{-- {{ $partWithFactors['part']->name }} - Total Rate: --}}
                                                <span class="box">
                                                    {{ $totalRates[$partWithFactors['part']->id] }}</span>
                                            </span>
                                        </strong>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </ul>
                    <div class="m-b-30 p-20"></div>
                    </li>
                @endif
            @endforeach
        </div>
        {{-- DISPLAY THE OTHER PARTS AND FACTORS --}}
        <button wire:click="submitStep3" class="btn btn-primary btn-right">Next</button>
        <button wire:click="goBack" class="btn btn-primary btn-left">Back</button>
    @elseif($currentStep === 4)
        <div>page 3</div>
    @elseif($currentStep === 0)
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


    <div class="m-t-30">
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
    <button wire:click="submitForm" class="btn btn-primary btn-right">Submit</button>
    @endif
</div>
