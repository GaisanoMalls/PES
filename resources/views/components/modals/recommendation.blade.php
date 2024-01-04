   <div class="modal fade" id="recommendationModal" tabindex="-1" role="dialog" aria-labelledby="recommendationModalLabel"
       aria-hidden="true">
       <div class="modal-dialog modal-lg" role="document"> <!-- Add 'modal-lg' class for a larger width -->
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="recommendationModalLabel">Recommendation</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <div class="m-t-10">
                       <div class="row">
                           <div class="col-md-6">
                               <div class="form-group">
                                   <label for="current_salary">Current Salary:</label>
                                   <input type="number" class="form-control" wire:model="currentSalary"
                                       wire:change="calculatePercentageIncrease"
                                       placeholder="{{ $evaluation->recommendation->current_salary ?? '' }}"
                                       @if (!$editMode) disabled @endif>
                               </div>
                           </div>
                           <div class="col-md-6">
                               <div class="form-group">
                                   <label for="recommended_salary">Recommended Salary:</label>
                                   <input type="number" class="form-control" wire:model="recommendedSalary"
                                       wire:change="calculatePercentageIncrease"
                                       placeholder="{{ $evaluation->recommendation->recommended_salary ?? '' }}"
                                       @if (!$editMode) disabled @endif>
                               </div>
                           </div>
                       </div>
                       <div class="form-group">
                           <label for="recommended_salary">Percentage Increase:</label>
                           <input type="number" class="form-control"
                               placeholder="{{ $evaluation->recommendation->percentage_increase }}" readonly disabled
                               wire:model="percentageIncrease">
                       </div>
                       <div class="row">
                           <div class="col-md-6">
                               <div class="form-group">
                                   <label for="recommended_position">Current Position:</label>
                                   <input type="text" class="form-control" wire:model="recommendedPosition"
                                       placeholder="{{ $evaluation->employee->position ?? '' }}"
                                       @if (!$editMode) disabled @endif>
                               </div>
                           </div>
                           <div class="col-md-6">
                               <div class="form-group">
                                   <label for="recommended_position">Recommended Position:</label>
                                   <input type="text" class="form-control" wire:model="recommendedPosition"
                                       placeholder="{{ $evaluation->recommendation->recommended_position ?? '' }}"
                                       @if (!$editMode) disabled @endif>
                               </div>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-md-6">
                               <div class="form-group">
                                   <label for="level">Current Level:</label>
                                   <input type="text" class="form-control" wire:model="level"
                                       placeholder="{{ $evaluation->employee->level ?? '' }}"
                                       @if (!$editMode) disabled @endif>
                               </div>
                           </div>
                           <div class="col-md-6">
                               <div class="form-group">
                                   <label for="level">Recommended Level:</label>
                                   <input type="text" class="form-control" wire:model="level"
                                       placeholder="{{ $evaluation->recommendation->level ?? '' }}"
                                       @if (!$editMode) disabled @endif>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           @php
                               $effectivity = optional($evaluation->recommendation)->effectivity;
                               $formattedEffectivity = $effectivity ? \Carbon\Carbon::parse($effectivity)->format('Y-m-d') : '';
                           @endphp

                           <label for="effectivityTimestamp">Effectivity Date:</label>
                           <input type="date" class="form-control" wire:model="effectivityTimestamp"
                               @if (!$editMode) disabled @endif value="{{ $formattedEffectivity }}">
                       </div>
                       <div class="form-group">
                           <label for="remarks">Remarks:</label>
                           <textarea name="remarks" id="remarks" rows="5" class="form-control" wire:model="remarks"
                               placeholder="{{ $evaluation->recommendation->remarks ?? '' }}" @if (!$editMode) disabled @endif></textarea>
                       </div>
                   </div>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>
           </div>
       </div>
