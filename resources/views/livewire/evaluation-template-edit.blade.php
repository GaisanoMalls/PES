<div>
    <form wire:submit.prevent="saveEvaluationTemplate">
        <div>
            <label for="name">Evaluation Template Name:</label>
            <input type="text" id="name" wire:model="name">
        </div>

        <div>
            <h3>Parts</h3>
            @foreach ($parts as $partIndex => $part)
                <div>
                    <label for="part_name_{{ $partIndex }}">Part Name:</label>
                    <input type="text" id="part_name_{{ $partIndex }}" wire:model="parts.{{ $partIndex }}.name">

                    <label for="criteria_allocation_{{ $partIndex }}">Criteria Allocation:</label>
                    <input type="number" step="0.01" id="criteria_allocation_{{ $partIndex }}"
                        wire:model="parts.{{ $partIndex }}.criteria_allocation">

                    <button type="button" wire:click="addFactor({{ $partIndex }})">Add Factor</button>

                    @foreach ($part['factors'] as $factorIndex => $factor)
                        <div>
                            <label for="factor_name_{{ $partIndex }}_{{ $factorIndex }}">Factor Name:</label>
                            <input type="text" id="factor_name_{{ $partIndex }}_{{ $factorIndex }}"
                                wire:model="parts.{{ $partIndex }}.factors.{{ $factorIndex }}.name">

                            <label for="factor_desc_{{ $partIndex }}_{{ $factorIndex }}">Factor
                                Description:</label>
                            <input type="text" id="factor_desc_{{ $partIndex }}_{{ $factorIndex }}"
                                wire:model="parts.{{ $partIndex }}.factors.{{ $factorIndex }}.description">

                            <label>Rating Scales and Equivalent Points:</label>
                            @foreach ($ratingScales as $scale)
                                <div>
                                    <label>{{ $scale['name'] }}</label>
                                    <input type="number" step="0.01"
                                        wire:model="parts.{{ $partIndex }}.factors.{{ $factorIndex }}.rating_scales.{{ $scale['id'] }}">
                                </div>
                            @endforeach
                            <button type="button"
                                wire:click="removeFactor({{ $partIndex }}, {{ $factorIndex }})">Remove
                                Factor</button>

                        </div>
                    @endforeach

                </div>
            @endforeach

            <button type="button" wire:click="addPart">Add Part</button>
        </div>

        <button type="submit">Create Evaluation Template</button>
    </form>
</div>
