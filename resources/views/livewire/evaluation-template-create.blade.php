<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create Evaluation Template Form</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="createEvaluationTemplate">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Evaluation Template Name</label>
                                    <input type="text" wire:model="name" class="form-control">
                                </div>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        @error('parts')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div>

                            <h4 class="card-title">Parts</h4>
                            @foreach ($parts as $partIndex => $part)
                                <div class="rating-scale"></div>
                                <div class="text-center">
                                    <h5 class="card-title">Part {{ $loop->iteration }}</h5>
                                </div>
                                <div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="part_name_{{ $partIndex }}">Part Name:</label>
                                                <input type="text" class="form-control"
                                                    id="part_name_{{ $partIndex }}"
                                                    wire:model="parts.{{ $partIndex }}.name">
                                                @error('parts.' . $partIndex . '.name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="criteria_allocation_{{ $partIndex }}">Criteria
                                                    Allocation:</label>
                                                <input class="form-control" type="number"
                                                    id="criteria_allocation_{{ $partIndex }}"
                                                    wire:model="parts.{{ $partIndex }}.criteria_allocation"
                                                    max="100">
                                                @error('parts.criteria_allocation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <button class="btn btn-outline-danger"
                                        wire:click.prevent="removePart({{ $partIndex }})">Remove
                                        Part</button>
                                    <div class="rating-scale"></div>

                                    <h4 class="card-title">Factors</h4>
                                    @error('parts.' . $partIndex . '.factors')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @foreach ($part['factors'] as $factorIndex => $factor)
                                        <div class="rating-scale"></div>
                                        <div class="text-center">
                                            <h5 class="card-title">Factor {{ $loop->iteration }}</h5>
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label
                                                            for="factor_name_{{ $partIndex }}_{{ $factorIndex }}">Factor
                                                            Name:</label>
                                                        <input class="form-control" type="text"
                                                            id="factor_name_{{ $partIndex }}_{{ $factorIndex }}"
                                                            wire:model="parts.{{ $partIndex }}.factors.{{ $factorIndex }}.name">
                                                        @error('parts.' . $partIndex . '.factors.' . $factorIndex .
                                                            '.name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label
                                                            for="factor_desc_{{ $partIndex }}_{{ $factorIndex }}">Factor
                                                            Description:</label>
                                                        <textarea class="form-control" type="text" id="factor_desc_{{ $partIndex }}_{{ $factorIndex }}"
                                                            wire:model="parts.{{ $partIndex }}.factors.{{ $factorIndex }}.description"></textarea>
                                                        @error('parts.' . $partIndex . '.factors.' . $factorIndex .
                                                            '.description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="rating-scale"></div>
                                            <h5 class="card-title">Rating Scales and Equivalent Points</h5>
                                            <div class="row d-flex justify-content-center">
                                                @foreach ($ratingScales as $scale)
                                                    <div class="col-md-2">
                                                        <label>{{ $scale['name'] }}</label>
                                                        <input class="form-control" type="number" step="0.01"
                                                            wire:model="parts.{{ $partIndex }}.factors.{{ $factorIndex }}.rating_scales.{{ $scale['id'] }}">
                                                    </div>
                                                @endforeach
                                                <div class="m-t-15">
                                                    @error('parts.' . $partIndex . '.factors.' . $factorIndex .
                                                        '.rating_scales')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="text-center m-t-15 m-b-20">
                                                <button type="button" class="btn btn-outline-danger active"
                                                    wire:click="removeFactor({{ $partIndex }}, {{ $factorIndex }})">Remove
                                                    Factor</button>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="text-right">
                                        <button class="btn btn-primary" type="button" data-toggle="modal"
                                            data-target="#addFactorModal_{{ $partIndex }}">Add Factor</button>
                                    </div>
                                </div>
                                <!-- Add Factor Modal -->
                                <div class="modal fade" id="addFactorModal_{{ $partIndex }}" tabindex="-1"
                                    role="dialog" aria-labelledby="addFactorModalLabel_{{ $partIndex }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addFactorModalLabel_{{ $partIndex }}">
                                                    Add Factor for Part {{ $loop->iteration }}
                                                </h5>

                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <!-- Modal content goes here, similar to the fields for adding a factor -->
                                                <div class="form-group">
                                                    <label for="newFactorName">Factor Name:</label>
                                                    <input type="text" class="form-control" id="newFactorName"
                                                        wire:model="newFactorName">
                                                </div>
                                                <div class="form-group">
                                                    <label for="newFactorDescription">Factor Description:</label>
                                                    <textarea class="form-control" id="newFactorDescription" wire:model="newFactorDescription"></textarea>
                                                </div>
                                                <!-- Rating Scales and Equivalent Points -->
                                                <div class="rating-scale"></div>
                                                <h5 class="card-title">Rating Scales and Equivalent Points</h5>
                                                <div class="row d-flex justify-content-center">
                                                    @foreach ($ratingScales as $scale)
                                                        <div class="col-md-2">
                                                            <label>{{ $scale['name'] }}</label>
                                                            <input class="form-control" type="number" step="0.01"
                                                                wire:model="newFactorRatingScales.{{ $scale['id'] }}">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @error('newFactorRatingScales')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary"
                                                    wire:click="addFactor({{ $partIndex }})"
                                                    data-dismiss="modal">Add
                                                    Factor</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="text-right m-t-15">
                                <button type="button" class="btn btn-primary" wire:click="addPart">Add Part</button>
                            </div>
                        </div>
                        <div class="text-right m-t-15">
                            <button type="submit" class="btn btn-primary">Create Evaluation Template</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
