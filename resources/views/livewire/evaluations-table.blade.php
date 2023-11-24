<!-- resources/views/livewire/evaluations-table.blade.php -->
<div class="m-t-30 p-t-10">





    <div class="row formtype">

        <div class="col-md-3 m-t-15">
            <h1>Evaluations</h1>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Employee ID - Name</label>
                <input wire:model="searchTerm" type="text" class="form-control mb-3"
                    placeholder="Search by Employee ID/Name">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Recommendations</label>
                <select wire:model="recommendationFilter" class="form-control">
                    <option value="All">All</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Status</label>
                <select wire:model="statusFilter" class="form-control">
                    <option value="All">All</option>
                    <option value="1">Pending</option>
                    <option value="2">Approved</option>
                    <option value="3">Disapproved</option>
                    <option value="4">Clarifications</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Search</label>
                <!-- Add search button -->
                <button wire:click="search" class="btn btn-success btn-block mt-0 search_button">
                    Search
                </button>
            </div>
        </div>
    </div>
    <!-- Button to toggle between all evaluations and user's evaluations -->
    @if ($userRoleId == 2)
        <button wire:click="toggleShowAllEvaluations" class="btn btn-primary mb-3">
            {{ $showAllEvaluations ? 'View My Evaluations' : 'View All Evaluations' }}
        </button>
    @endif

    <table class="table bg-white table-active table-bordered">
        <thead>
            <tr class="text-center">
                <th>ID</th>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <!-- Date of Evaluation sorting -->
                <th class="pointer" wire:click="sortByDate('created_at')">Date of Evaluation
                    @if ($sortFieldDate === 'created_at')
                        @if ($sortAscDate)
                            <i class="fas fa-caret-up"></i>
                        @else
                            <i class="fas fa-caret-down"></i>
                        @endif
                    @else
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    @endif
                </th>
                <th class="pointer" wire:click="sortByTotalRate('totalRate')">Total Rate
                    @if ($sortFieldTotalRate === 'totalRate')
                        @if ($sortAscTotalRate)
                            <i class="fas fa-caret-up"></i>
                        @else
                            <i class="fas fa-caret-down"></i>
                        @endif
                    @else
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    @endif
                </th>


                <th>Recommendation Note</th>
                <th>Ratees comment</th>
                <th>Evaluated By</th>
                <th>Recommendations</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($evaluations as $evaluation)
                @if ($userRoleId == 5 && $evaluation->status != 2)
                    @continue
                @endif

                <tr class="text-center">
                    <td>{{ $evaluation->id }}</td>
                    <td>{{ $evaluation->employee->employee_id }}</td>
                    <td>{{ $evaluation->employee->last_name . ', ' . $evaluation->employee->first_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($evaluation->created_at)->format('F d, Y') }}</td>
                    <td>{{ $evaluationTotals[$evaluation->id] }}</td>
                    <td>{{ $evaluation->recommendation_note }}</td>
                    <td>{{ $evaluation->ratees_comment }}</td>
                    <td>{{ $evaluation->evaluatorEmployee->first_name }}
                        {{ $evaluation->evaluatorEmployee->last_name }}
                    </td>
                    <td>
                        @if (\App\Models\Recommendation::where('evaluation_id', $evaluation->id)->exists())
                            <a href="#" class="btn btn-sm bg-success-light mr-2">
                                Yes</a>
                        @else
                            <a href="#" class="btn btn-sm bg-danger-light mr-2">
                                No</a>
                        @endif
                    </td>
                    <td>
                        @if ($evaluation->status == 1)
                            <div class="actions">
                                <a href="#" class="btn btn-sm bg-default-light mr-2">Pending</a>
                            </div>
                        @elseif($evaluation->status == 2)
                            <div class="actions">
                                <a href="#" class="btn btn-sm bg-success-light mr-2">Approved</a>
                            </div>
                        @elseif($evaluation->status == 3)
                            <div class="actions">
                                <a href="#" class="btn btn-sm bg-danger-light mr-2">Disapproved</a>
                            </div>
                        @elseif($evaluation->status == 4)
                            <div class="actions">
                                <a href="#" class="btn btn-sm bg-default-light mr-2">Clarifications</a>
                            </div>
                        @endif
                    </td>

                    <td>
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false"><i class="fas fa-ellipsis-v ellipse_color"></i></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                @if (
                                    (Auth::user()->role_id == 3 && $evaluation->status == 1) ||
                                        (Auth::user()->role_id == 3 && $evaluation->status == 4))
                                    <a class="dropdown-item"
                                        href="{{ route('evaluations.review', ['evaluation' => $evaluation->id]) }}">
                                        Review
                                    </a>
                                @elseif(Auth::user()->employee_id == $evaluation->approver_id)
                                    <a class="dropdown-item"
                                        href="{{ route('evaluations.review', ['evaluation' => $evaluation->id]) }}">
                                        Edit Review
                                    </a>
                                @endif

                                <a class="dropdown-item"
                                    href="{{ route('evaluations.pdf', ['evaluation' => $evaluation->id]) }}">Generate
                                    PDF</a>

                                @if (Auth::user()->role_id == 3 && ($evaluation->status == 2 || $evaluation->status == 3))
                                    <a class="dropdown-item" wire:click="approveEvaluation({{ $evaluation->id }})">
                                        Mark as pending</a>
                                @endif

                                @if ($evaluation->evaluator_id == Auth::user()->employee_id)
                                    <a class="dropdown-item"
                                        href="{{ route('evaluations.edit', ['evaluation' => $evaluation->id]) }}">
                                        Edit evaluation
                                    </a>
                                @endif

                                @if ($evaluation->evaluator_id == Auth::user()->employee_id)
                                    <a class="dropdown-item" wire:click="deleteEvaluation({{ $evaluation->id }})">
                                        @csrf
                                        Delete
                                    </a>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
