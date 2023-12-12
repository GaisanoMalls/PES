 <div class="m-t-30">
     @if ($clarifications->count() > 0)
         @foreach ($clarifications as $clarification)
             <div class="widget author-widget">
                 <span class="blog-author-name">{{ $clarification->commentorName->first_name }}
                     {{ $clarification->commentorName->last_name }} -
                     {{ $clarification->commentor->role->name }}</span>
                 <span class="span-left">{{ $clarification->created_at->diffForHumans() }}</span>
                 <div class="about-author">
                     <div class="author-details">
                         @if ($editingClarificationId === $clarification->id)
                             <textarea wire:model="clarificationDescription" class="form-control" placeholder="Write your clarifications.."></textarea>
                             <a href="#"
                                 wire:click.prevent="submitClarification({{ $clarification->id }})">Update</a>
                             <a href="#" wire:click.prevent="cancelEdit">Cancel</a>
                         @else
                             <p>
                                 {{ $clarification->description }}</p>
                             @auth
                                 @if (auth()->user()->employee_id == $clarification->commentor_id)
                                     <a href="#" wire:click.prevent="deleteClarification({{ $clarification->id }})"
                                         class="span-ED">Delete</a>
                                     @if ($editingClarificationId === $clarification->id)
                                         <a href="#" wire:click.prevent="cancelEdit" class="span-ED">Cancel</a>
                                     @else
                                         <a href="#" wire:click.prevent="editClarification({{ $clarification->id }})"
                                             class="span-ED">Update</a>
                                     @endif
                                 @endif
                             @endauth
                         @endif
                     </div>
                 </div>
             </div>
         @endforeach
     @else
         <p>No clarifications available.</p>
     @endif
     <div class="form-group">
         @if ($editingClarificationId)
         @else
             <label for="description">Description:</label>
             <textarea rows="3" @if (!$editingClarificationId) wire:model="clarificationDescription" @endif id="description"
                 class="form-control" placeholder="Write your clarifications.."></textarea>
             <div class="m-t-15">
                 <button wire:click="submitClarification" class="btn btn-outline-success btn-center">Submit
                     Clarification</button>
             </div>
         @endif
     </div>
 </div>
