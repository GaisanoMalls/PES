           {{-- EVALUATORS OR APPROVERS INPUTS --}}
           <div class="row">
               <div class="col-md-6">
                   <div class="form-group row">
                       <label class="col-lg-3 col-form-label">RATED BY: </label>
                       <div class="col-lg-7">
                           <a href="#" class="btn btn-m bg-success-light mb-2 text-center strong-text form-control"
                               style="cursor: default;">{{ $evaluation->evaluatorEmployee->first_name . ' ' . $evaluation->evaluatorEmployee->last_name }}
                               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                   class="main-grid-item-icon" fill="none" stroke="currentColor"
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

               <div class="col-md-6">
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
                                       height="24" class="main-grid-item-icon" fill="none" stroke="currentColor"
                                       stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
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
                           placeholder="{{ $evaluation->recommendation_note }}"></textarea>
                   </div>
               </div>
           </div>
           {{-- END EVALUATORS OR APPROVERS INPUTS --}}

           {{-- EMPLOYEE INPUTS --}}
           <div class="row m-t-50">
               <div class="col-md-6">
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
                       placeholder="{{ $evaluation->ratees_comment }}"></textarea>
               </div>
           </div>
           {{-- END EMPLOYEE INPUTS --}}
