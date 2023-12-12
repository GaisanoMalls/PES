<div class=" m-t-50">
    <div class="container22 m-b-10">
        {{-- EVALUATION STATUS --}}
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
        @elseif ($evaluation->status === 1)
            <a href="#" class="btn btn-lg bg-warning-pending mb-2" style="cursor: default;">Pending
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                    class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <polyline points="12 6 12 12 16 14" />
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
        {{-- END EVALUATION STATUS --}}

    </div>
    @if ($currentStep === 1)
        {{-- EVALUATION DETAILS --}}
        <span>Non-Supervisory (Support & Non-Sales)</span>
        <h1>{{ $evaluation->evaluationTemplate->name }}</h1>
        <form wire:submit.prevent="submitStep1">
            @csrf
            <div class="m-t-20 m-b-30">
                @include('components.evaluation-employee-details', ['evaluation' => $evaluation])
            </div>
            {{-- END EVALUATION DETAILS --}}
            <div class="bg-white2">
                <div>
                    {{-- PARTS | FACTORS --}}
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
                                                            @if ($loop->first)
                                                                <h5 class="m-l-90 m-b-30">
                                                                    Factors</h5>
                                                            @endif
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
                                                                        {{ $ratingScale->acronym }}<br>
                                                                        {{ $ratingScale->equivalent_points }}<br>
                                                                        @if ($editMode)
                                                                            <input
                                                                                wire:click="updateSelectedValue({{ $ratingScale->factor_id }}, {{ $ratingScale->equivalent_points }})"
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
                                                                        @if ($loop->first)
                                                                            <span>OLD POINT<br><br>
                                                                        @endif
                                                                        <span
                                                                            id="old-points-{{ $factorData['factor']->id }}"
                                                                            class="box">
                                                                            {{ $originalValues[$factorData['factor']->id] ?? 0 }}
                                                                        </span>
                                                                    </label>
                                                                    <label class="radio-inline">
                                                                        @if ($loop->first)
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
                                                                        @if ($loop->first)
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
                                                                    <textarea class="form-control" placeholder="{{ $originalNotes[$factorData['factor']->id] ?? '' }}" rows="3"
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
        {{-- END OF PARTS | FACTORS --}}
    @elseif ($currentStep === 2)
        <div class="bg-white2 p-20">
            {{-- SUMMARY TABLE --}}
            @include('components.summary-table-review', ['evaluation' => $evaluation])
            {{-- SUMMARY TABLE --}}

            {{-- EVALUATORS OR APPROVERS INPUTS --}}
            <div class="row">
                <div class="col-xl-6">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">RATED BY: </label>
                        <div class="col-lg-7">
                            <a href="#"
                                class="btn btn-m bg-success-light mb-2 text-center strong-text form-control"
                                style="cursor: default;">{{ $evaluation->evaluatorEmployee->first_name . ' ' . $evaluation->evaluatorEmployee->last_name }}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                    height="24" class="main-grid-item-icon" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                    <polyline points="22 4 12 14.01 9 11.01" />
                                </svg>
                            </a>
                            <p class="text-center">
                                {{ $evaluation->evaluatorEmployee->department->name . ' - ' . $evaluation->evaluatorEmployee->position }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">REVIEWED BY: </label>
                        <div class="col-lg-7">
                            @if ($evaluation->approver_id)
                                <a href="#"
                                    @if ($evaluation->status == 2) class="btn btn-m bg-success-light mb-2 text-center strong-text form-control"
                                   @elseif ($evaluation->status == 3)
                                   class="btn btn-m bg-danger-light mb-2 text-center strong-text form-control"   @else class="btn btn-m bg-warning-light mb-2 text-center strong-text form-control" @endif
                                    style="cursor: default;">{{ $evaluation->approverEmployee->first_name . ' ' . $evaluation->approverEmployee->last_name }}
                                    @if ($evaluation->status == 2)
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                            height="24" class="main-grid-item-icon" fill="none"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                            <polyline points="22 4 12 14.01 9 11.01" />
                                        </svg>
                                    @elseif ($evaluation->status == 3)
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                            height="24" class="main-grid-item-icon" fill="none"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2">
                                            <circle cx="12" cy="12" r="10" />
                                            <line x1="15" x2="9" y1="9" y2="15" />
                                            <line x1="9" x2="15" y1="9" y2="15" />
                                        </svg>
                                    @elseif ($evaluation->status == 4)
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                            height="24" class="main-grid-item-icon" fill="none"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2">
                                            <circle cx="12" cy="12" r="10" />
                                            <line x1="12" x2="12" y1="8" y2="12" />
                                            <line x1="12" x2="12.01" y1="16" y2="16" />
                                        </svg>
                                    @endif
                                </a>
                            @else
                                <a href="#"
                                    class="btn btn-m bg-warning-pending mb-2 text-center strong-text form-control"
                                    style="cursor: default;">Pending Review
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                        height="24" class="main-grid-item-icon" fill="none"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                </a>
                            @endif
                            <p class="text-center">
                                @if ($evaluation->approver_id)
                                    {{ $evaluation->approverEmployee->department->name . ' - ' . $evaluation->approverEmployee->position }}
                                @else
                                    APPROVER
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-t-15">
                <div class="comment">
                    <div class="form-group">
                        <label for="recommendations">RECOMMENDATION:</label>
                        <textarea class="form-control" wire:model="recommendationNote" rows="4"
                            placeholder="{{ $evaluation->recommendation_note }}" @if (!$editMode) disabled @endif></textarea>
                    </div>
                </div>
            </div>
            {{-- END EVALUATORS OR APPROVERS INPUTS --}}

            {{-- EMPLOYEE INPUTS --}}
            <div class="row m-t-50">
                <div class="col-xl-6">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">READ: </label>
                        <div class="col-lg-7">
                            @if ($evaluation->ratees_comment == null)
                                <a class="btn btn-m bg-warning-pending mb-2 text-center strong-text form-control"
                                    style="cursor: default;">{{ $evaluation->employee->first_name . ' ' . $evaluation->employee->last_name }}
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                        height="24" class="main-grid-item-icon" fill="none"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                </a>
                                <p class="text-center">
                                    NAME OF EMPLOYEE
                                </p>
                            @else
                                <a href="#"
                                    class="btn btn-m bg-success-light mb-2 text-center strong-text form-control"
                                    style="cursor: default;">{{ $evaluation->employee->first_name . ' ' . $evaluation->employee->last_name }}
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                        height="24" class="main-grid-item-icon" fill="none"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                        <polyline points="22 4 12 14.01 9 11.01" />
                                    </svg>
                                </a>
                                <p class="text-center">
                                    {{ $evaluation->employee->department->name . ' - ' . $evaluation->employee->position }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="comment m-t-15">
                <div class="form-group">
                    <label for="ratee_comments">RATEE’S COMMENTS:</label>
                    <textarea class="form-control" wire:model="rateesComment" rows="4"
                        placeholder="{{ $evaluation->ratees_comment }}" @if (!$editMode) disabled @endif
                        @if ($evaluation->employee_id == Auth::user()->employee_id) readonly @endif></textarea>
                </div>
            </div>
            {{-- END EMPLOYEE INPUTS --}}


            {{-- CLARIFICATIONS --}}
            @if ($showClarificationSection)
                @include('components.clarification', ['clarifications' => $clarifications])
            @endif
            {{-- END CLARIFICATIONS --}}



            {{-- BUTTONS --}}
            <a href="{{ route('evaluations.edit', ['evaluation' => $evaluation->id]) }}"><button
                    class="btn btn-outline-success m-t-15">Back</button></a>

            @if ($evaluation->status === 2 || $evaluation->status === 3 || !$editMode)
            @else
                <button wire:click="updateEvaluation" class="btn btn-outline-success btn-right">Update
                    Evaluation</button>
            @endif

            @if ($evaluation->recommendation)
                <button type="button" class="btn btn-outline-secondary btn-right m-r-5" data-toggle="modal"
                    data-target="#recommendationModal">
                    View Recommendation
                </button>
            @endif
            <button wire:click="displayClarificationSection" class="btn btn-outline-secondary btn-right m-r-5 "
                @if ($showClarificationSection) disabled @endif>View
                Clarifications</button>
    @endif
    {{-- END PAGE 2 --}}


    {{-- MODALS --}}
    @if ($evaluation->recommendation)
        @include('components.modals.recommendation', [
            'evaluation' => $evaluation,
            'editMode' => $editMode,
        ])
    @endif

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
<script>
    $(document).ready(function() {
        $('#recommendationModal').modal({
            backdrop: 'static',
            keyboard: false
        })
    });
</script>
