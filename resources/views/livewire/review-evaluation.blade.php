<div class="m-t-50">
    <div class="container22 m-b-10">
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
            <a data-toggle="modal" data-target="#disapproveModal2" class="" style="cursor: pointer;">
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
                <!-- https://feathericons.dev/?search=clock&iconset=feather -->
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

    </div>

    @if ($currentStep === 1)
        <span>Non-Supervisory (Support & Non-Sales)</span>
        <h1>{{ $evaluation->evaluationTemplate->name }}</h1>

        <form wire:submit.prevent="submitStep1">
            @csrf
            <div class="m-t-20 m-b-30">

                @include('components.evaluation-employee-details', ['evaluation' => $evaluation])

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
                                @foreach ($partWithFactors['factors'] as $factorData)
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
                                                        <input disabled class="custom-radio" type="radio"
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
                                                    <span id="points-{{ $factorData['factor']->id }}" class="box">
                                                        {{ $selectedValues[$factorData['factor']->id] ?? 0 }}
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="comment m-t-10">
                                                <div class="form-group">
                                                    <label for="">Specific
                                                        situations/incidents
                                                        to support rating:</label>
                                                    <textarea class="form-control" rows="3" readonly disabled>{{ $factorNotes[$factorData['factor']->id] ?? '' }}</textarea> {{-- Display the factor note --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    @if ($loop->last)
                                        <div class="c m-t-20 m-r-15">
                                            <strong>
                                                <span>Total Actual Points/Rate =
                                                    <span class="box">
                                                        {{ $partWithFactors['totalRate'] }}</span>
                                                </span>
                                            </strong>
                                        </div>
                                    @endif
                                @endforeach
                        @endforeach
                    </ul>
                </div>
            </div>
            <button wire:click="submitStep1" class="btn btn-outline-success btn-right">Rating Summary</button>
        </form>
    @elseif ($currentStep === 2)
        <div class="bg-white2 p-20">
            @include('components.summary-table-review', ['evaluation' => $evaluation])

        </div>


        <div class="row">
            <div class="col-xl-6">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">RATED BY: </label>
                    <div class="col-lg-7">
                        <a class="btn btn-m bg-success-light mb-2 text-center strong-text form-control"
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
        </div>


        <div class="row">
            <div class="col-xl-6">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">REVIEWED BY: </label>
                    <div class="col-lg-7">
                        @if ($evaluationApprovers->isEmpty())
                            <a href="#"
                                class="btn btn-m bg-warning-pending mb-2 text-center strong-text form-control"
                                style="cursor: default;">PENDING
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                    height="24" class="main-grid-item-icon" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <polyline points="12 6 12 12 16 14" />
                                </svg>
                            </a>
                            <p class="text-center">
                                ---
                            </p>
                        @else
                            @foreach ($evaluationApprovers as $index => $approver)
                                @php
                                    $hasApproved = $approver->approver_level <= $evaluation->approver_count;
                                    $greenLightClass = $hasApproved ? 'btn btn-m bg-success-light mb-2 text-center strong-text form-control' : 'btn btn-m bg-warning-pending mb-2 text-center strong-text form-control';
                                @endphp
                                <a href="#"
                                    class="{{ $evaluation->status == 2 || ($evaluation->status == 3 && $hasApproved) ? $greenLightClass : ($evaluation->status == 3 ? 'btn btn-m bg-danger-light mb-2 text-center strong-text form-control' : ($evaluation->status == 4 ? 'btn btn-m bg-warning-light mb-2 text-center strong-text form-control' : $greenLightClass)) }}"
                                    style="cursor: default;">
                                    {{ $approver->employee->first_name . ' ' . $approver->employee->last_name }}
                                    @if ($evaluation->status == 2 || $hasApproved)
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                            height="24" class="main-grid-item-icon" fill="none"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                            <polyline points="22 4 12 14.01 9 11.01" />
                                        </svg>
                                    @elseif ($evaluation->status == 1)
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                            height="24" class="main-grid-item-icon" fill="none"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2">
                                            <circle cx="12" cy="12" r="10" />
                                            <polyline points="12 6 12 12 16 14" />
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
                                    @elseif ($evaluation->status == 3)
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                            height="24" class="main-grid-item-icon" fill="none"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2">
                                            <circle cx="12" cy="12" r="10" />
                                            <line x1="15" x2="9" y1="9" y2="15" />
                                            <line x1="9" x2="15" y1="9" y2="15" />
                                        </svg>
                                    @endif
                                </a>
                                <p class="text-center">
                                    {{ 'Level: ' . $approver->approver_level . ' (' . $approver->employee->department->name . ' - ' . $approver->employee->position . ')' }}
                                </p>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>




        <div class="m-t-15">
            <div class="comment">
                <div class="form-group">
                    <label for="recommendations">RECOMMENDATION:</label>
                    <textarea name="recommendations" id="recommendations" placeholder="Write a message" rows="4"
                        class="form-control" readonly disabled>{{ $evaluation->recommendation_note }}</textarea>
                </div>
            </div>
        </div>

        <div class="row m-t-30">
            <div class="col-xl-6">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">ACKNOWLEDGED: </label>
                    <div class="col-lg-7">
                        @if ($evaluation->ratees_comment == null)
                            <a class="btn btn-m bg-warning-pending mb-2 text-center strong-text form-control"
                                style="cursor: default;">{{ $evaluation->employee->first_name . ' ' . $evaluation->employee->last_name }}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                    height="24" class="main-grid-item-icon" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
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
                                    height="24" class="main-grid-item-icon" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
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



        <div class="comment m-t-5">
            <div class="form-group">
                <label for="ratee_comments">RATEE’S COMMENTS:</label>
                <textarea wire:model="rateeComment" id="ratee_comments" rows="4"
                    @if (Auth::user()->role_id == 4) placeholder="Write a comment to your evaluation" @endif class="form-control"
                    @if (!$isEditing) readonly @endif></textarea>
            </div>
            @if (Auth::user()->role_id == 4)
                @if (!$isEditing)
                    @if ($evaluation->ratees_comment == null)
                        <button wire:click="setEditMode" class="btn btn-secondary m-b-30">
                            Add Comment
                        </button>
                    @endif
                    @if ($evaluation->ratees_comment != null)
                        <button wire:click="setEditMode" class="btn btn-secondary m-b-30">
                            Edit
                        </button>
                    @endif
                @else
                    <button wire:click.once="storeRateeComment" class="btn btn-primary m-b-30">
                        Save
                    </button>
                    <button wire:click="setViewMode" class="btn btn-secondary m-b-30">
                        Cancel
                    </button>
                @endif
            @endif

        </div>


        {{-- CLARIFICATIONS --}}
        @if ($showClarificationSection)
            @include('components.clarification', ['clarifications' => $clarifications])
        @endif
        {{-- END CLARIFICATIONS --}}


        <div class="m-b-15 m-t-15">
            <a href="{{ route('evaluations.review', ['evaluation' => $evaluation->id]) }}"><button
                    class="btn btn-outline-success m-t-15">Back</button></a>
            @if (Auth::user()->role_id != 4 && Auth::user()->role_id != 5)

                @if ($evaluation->status != 2)
                    <button wire:click="approveEvaluation" wire:loading.attr="disabled"
                        @if ($isApproverLevelValid == false) disabled @endif
                        class="btn btn-outline-success btn-right mr-2"
                        @if ($evaluation->status == 3) style="display: none;" @endif> <span wire:loading
                            wire:target="approveEvaluation" class="spinner-border spinner-border-sm mr-2"
                            role="status"></span>
                        <span wire:loading.remove wire:target="approveEvaluation"></span>Approve Evaluation
                    </button>


                    {{-- disapprover evaluation --}}
                    <button data-toggle="modal" data-target="#disapproveModal"
                        @if ($evaluation->status == 3) style="display: none;" @endif
                        @if ($isApproverLevelValid == false) disabled @endif
                        @if ($evaluation->status == 3) class="btn btn-outline-secondary btn-right m-r-5 " disabled @else class="btn btn-outline-danger btn-right mr-2" @endif>Disapprove
                        Evaluation
                    </button>
                @endif

                {{-- recommendation button --}}
                @if ($evaluation->recommendation && Auth::user()->role_id == 3)
                    <button type="button" class="btn btn-outline-secondary btn-right m-r-5" data-toggle="modal"
                        data-target="#recommendationModal">
                        View Recommendation
                    </button>
                @endif
            @endif
            {{-- view clarifications button --}}
            <button wire:click="displayClarificationSection" class="btn btn-outline-secondary btn-right m-r-5"
                @if ($showClarificationSection) disabled @endif>View
                Clarifications</button>
        </div>

    @endif

    <!-- Modal -->
    @if ($evaluation->recommendation)
        @php
            $editMode = false; // Set editMode to false in review.blade.php
        @endphp
        @include('components.modals.recommendation', [
            'evaluation' => $evaluation,
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
                        <textarea wire:model="disapprovalDescription" id="description" placeholder="Please state the reason for disapproval"
                            class="form-control">{{ $evaluation }}</textarea>
                        @error('disapprovalDescription')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    @if ($evaluation->status != 3)
                        <button wire:click="disapproveEvaluation" wire:loading.attr="disabled"
                            @if ($evaluation->status == 3) class="btn btn-outline-secondary btn-right" disabled @else  class="btn btn-outline-danger btn-right" @endif
                            @unless ($errors->has('disapprovalDescription')) data-dismiss="modal" @endif>
                        <span wire:loading wire:target="disapproveEvaluation"
                            class="spinner-border spinner-border-sm mr-2" role="status">Loading..</span>
                        <span wire:loading.remove>
                            Disapprove Evaluation
                        </span>
                    </button>
                 @endif
                            </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="disapproveModal2" tabindex="-1" role="dialog"
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
</div
