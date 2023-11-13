<div>
    <span>Non-Supervisory (Support & Non-Sales)</span>
    <h1>{{ $templateName }}</h1>
    <form wire:submit.prevent="submitStep1">
        @csrf

        <div class="bg-white">
            <div>
                <ul style="list-style: none;">
                    @foreach ($partsWithFactors as $partWithFactors)
                        <li style="list-style: none;">
                            <h4 class="text-center">{{ $partWithFactors['part']->name }}</h4>
                            <ul style="list-style: none;">
                                @foreach ($partWithFactors['factors'] as $factorData)
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
                                                                value="{{ $ratingScale->rating_scale_id }}"
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
                                                        <label for="">Specific situations/incidents to
                                                            support rating:</label>
                                                        <textarea placeholder="Type here..." class="form-control" wire:model="factorNotes.{{ $factorData['factor']->id }}"
                                                            wire:change="updateNote({{ $factorData['factor']->id }}, $event.target.value)"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="c m-t-20 m-r-15">
                                <strong>
                                    <span>Total Actual Points/Rate =
                                        {{-- {{ $partWithFactors['part']->name }} - Total Rate: --}}
                                        <span class="box">
                                            {{ $totalRates[$partWithFactors['part']->id] }}</span>
                                    </span>
                                </strong>
                            </div>
                            <div class="m-b-30 p-20"></div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <button wire:click="submitStep1" class="btn btn-primary btn-right">Next Page>></button>
    </form>

</div>
