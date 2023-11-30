<div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create Evaluation Template Form</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="saveEvaluationTemplate">
                        <div class="form-group">
                            <label>Evaluation Template Name</label>
                            <input type="text" wire:model="name" class="form-control">
                        </div>
                        <div>

                            @foreach ($parts as $partIndex => $part)
                                <div class="rating-scale"></div>
                                <div class="text-center">
                                    <h4 class="card-title">Part {{ $loop->iteration }}</h4>
                                </div>
                                <div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="part_name_{{ $partIndex }}">Part Name:</label>
                                                <input type="text" class="form-control"
                                                    id="part_name_{{ $partIndex }}"
                                                    wire:model="parts.{{ $partIndex }}.name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="criteria_allocation_{{ $partIndex }}">Criteria
                                                    Allocation:</label>
                                                <input class="form-control" type="number" step="0.01"
                                                    id="criteria_allocation_{{ $partIndex }}"
                                                    wire:model="parts.{{ $partIndex }}.criteria_allocation">
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-outline-danger"
                                        wire:click.prevent="removePart({{ $partIndex }})">Remove
                                        Part</button>
                                    @foreach ($part['factors'] as $factorIndex => $factor)
                                        <div class="rating-scale"></div>

                                        <h5 class="card-title">Factor {{ $loop->iteration }}</h5>

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
                                                            wire:model="parts.{{ $partIndex }}.factors.{{ $factorIndex }}.description"> </textarea>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="rating-scale"></div>
                                            <h6 class="card-title">Rating Scales and Equivalent Points</h6>
                                            <div class="row d-flex justify-content-center">
                                                @foreach ($ratingScales as $scale)
                                                    <div class="col-md-2">
                                                        <label>{{ $scale['name'] }}</label>
                                                        <input class="form-control" type="number" step="0.01"
                                                            wire:model="parts.{{ $partIndex }}.factors.{{ $factorIndex }}.rating_scales.{{ $scale['id'] }}">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="text-center m-t-15 m-b-20">
                                                <button type="button" class="btn btn-outline-danger"
                                                    wire:click="removeFactor({{ $partIndex }}, {{ $factorIndex }})">Remove
                                                    Factor</button>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="text-right">
                                        <button class="btn btn-outline-success" type="button"
                                            wire:click="addFactor({{ $partIndex }})">Add
                                            Factor</button>
                                    </div>
                                </div>
                            @endforeach
                            <div class="text-right m-t-15">
                                <button type="button" class="btn btn-outline-success" wire:click="addPart">Add
                                    Part</button>
                            </div>
                        </div>
                        <div class="text-right m-t-15">
                            <button type="submit" class="btn btn-primary">Update Evaluation Template</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




</div>
