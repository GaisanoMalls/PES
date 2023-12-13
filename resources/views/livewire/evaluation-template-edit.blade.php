<div>
    <div class="row m-t-30">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Evaluation Template</h4>

                    <div class="text-left">
                        @if ($status == 1)
                            <a href="#" class="btn btn-m bg-success-light  m-t-15"
                                style="cursor: default;"><strong>Published</strong></a>
                        @elseif ($status == 2)
                            <a href="#" class="btn btn-m bg-default-light  m-t-15"
                                style="cursor: default;"><strong>Unpublished</strong></a>
                        @else
                            <a href="#" class="btn btn-m bg-default-light  m-t-15"
                                style="cursor: default;"><strong>On
                                    Progress</strong></a>
                        @endif
                    </div>

                    <div class="text-right">

                        <button wire:click="toggleEditMode" class="btn btn-outline-secondary">
                            @if ($editMode)
                                View
                            @else
                                Edit
                            @endif
                        </button>
                        <a href="{{ route('templates.index') }}" class="btn btn-outline-info ml-3" wire:model="editMode"
                            wire:loading.attr="disabled">
                            Back
                        </a>

                    </div>
                </div>

                <div class="card-body">
                    <form wire:submit.prevent="saveEvaluationTemplate">
                        <div class="form-group">
                            <label>Evaluation Template Name</label>
                            <input type="text" wire:model="name" class="form-control"
                                @if ($editMode) @else readonly @endif>
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
                                                    wire:model="parts.{{ $partIndex }}.name"
                                                    @if ($editMode) @else readonly @endif>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="criteria_allocation_{{ $partIndex }}">Criteria
                                                    Allocation:</label>
                                                <input class="form-control" type="number" step="0.01"
                                                    id="criteria_allocation_{{ $partIndex }}"
                                                    wire:model="parts.{{ $partIndex }}.criteria_allocation"
                                                    @if ($editMode) @else readonly @endif>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-outline-danger"
                                        wire:click.prevent="removePart({{ $partIndex }})"
                                        @if (!$editMode) hidden @endif>Remove
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
                                                            wire:model="parts.{{ $partIndex }}.factors.{{ $factorIndex }}.name"
                                                            @if ($editMode) @else readonly @endif>
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
                                                            wire:model="parts.{{ $partIndex }}.factors.{{ $factorIndex }}.description"
                                                            @if ($editMode) @else readonly @endif> </textarea>
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
                                                            wire:model="parts.{{ $partIndex }}.factors.{{ $factorIndex }}.rating_scales.{{ $scale['id'] }}"
                                                            @if ($editMode) @else readonly @endif>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="text-center m-t-15 m-b-20">
                                                <button type="button" class="btn btn-outline-danger"
                                                    wire:click="removeFactor({{ $partIndex }}, {{ $factorIndex }})"
                                                    @if (!$editMode) hidden @endif>Remove
                                                    Factor</button>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="text-right">
                                        <button class="btn btn-outline-success" type="button"
                                            wire:click="addFactor({{ $partIndex }})"
                                            @if (!$editMode) hidden @endif>Add
                                            Factor</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-right m-t-10">

                            <button type="button" class="btn btn-outline-success" wire:click="addPart"
                                @if (!$editMode) hidden @endif>Add Part</button>
                        </div>
                        <div class="text-right m-t-30">
                            <button type="button" class="btn btn-success" wire:click="saveAsAnotherTemplate"
                                @if (!$editMode) hidden @endif>Save As Another Template</button>
                            <button type="submit" class="btn btn-primary"
                                @if (!$editMode) hidden @endif>Update Evaluation Template</button>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
