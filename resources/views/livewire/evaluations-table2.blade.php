<!-- resources/views/livewire/evaluations-table.blade.php -->
<div class="m-t-30 p-t-10">
    <div class="col-md-3 m-t-15">
        <h4>Employees Evaluation</h4>
    </div>
    <div class="row formtype">

        <div class="col-md-3">
            <div class="form-group">
                <label>Employee ID - Name</label>
                <input wire:model.debounce.300ms="searchName" type="text" class="form-control mb-3"
                    placeholder="Search by Employee ID/Name">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Department</label>
                <select wire:model.debounce.300ms="departmentFilter" class="form-control">
                    <option value="">All</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Recommendations</label>
                <select wire:model.debounce.300ms="recommendationFilter" class="form-control">
                    <option value="All">All</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Status</label>
                <select wire:model.debounce.300ms="statusFilter" class="form-control">
                    <option value="All">All</option>
                    <option value="1">Pending</option>
                    <option value="2">Approved</option>
                    <option value="3">Disapproved</option>
                    <option value="4">Clarifications</option>
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Search</label>
                <!-- Add search button -->
                <button wire:click="search" class="btn btn-outline-success btn-block mt-0">
                    Search
                </button>
            </div>
        </div>

    </div>

    <table class="table bg-white table-active table-bordered">
        <thead>
            <tr class="text-center">
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Department</th>
                <th>Date of Evaluation</th>
                <th>Total Rate</th>
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
                    <td>{{ $evaluation->employee->employee_id }}</td>
                    <td>{{ $evaluation->employee->last_name . ', ' . $evaluation->employee->first_name }}</td>
                    <td>{{ $evaluation->employee->department->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($evaluation->created_at)->format('F d, Y') }}</td>
                    <td>{{ $evaluationTotals[$evaluation->id] }}</td>
                    <td>{{ $evaluation->recommendation_note }}</td>
                    <td>{{ $evaluation->ratees_comment }}</td>
                    <td>{{ $evaluation->evaluatorEmployee->first_name }}
                        {{ $evaluation->evaluatorEmployee->last_name }}
                    </td>
                    <td>
                        @if (\App\Models\Recommendation::where('evaluation_id', $evaluation->id)->exists())
                            <a href="#" class="btn btn-sm bg-success-light mr-2" style="cursor: default;">
                                Yes</a>
                        @else
                            <a href="#" class="btn btn-sm bg-danger-light mr-2" style="cursor: default;">
                                No</a>
                        @endif
                    </td>
                    <td>
                        @if ($evaluation->status == 1)
                            <div class="actions">
                                <a href="#" class="btn-sm bg-default-light mr-2"
                                    style="cursor: default;">Pending</a>
                            </div>
                        @elseif($evaluation->status == 2)
                            <div class="actions">
                                <a href="#" class="btn btn-sm bg-success-light mr-2"
                                    style="cursor: default;">Approved</a>
                            </div>
                        @elseif($evaluation->status == 3)
                            <div class="actions">
                                <a href="#" class="btn btn-sm bg-danger-light mr-2"
                                    style="cursor: default;">Disapproved</a>
                            </div>
                        @elseif($evaluation->status == 4)
                            <div class="actions">
                                <a href="#" class="btn btn-sm bg-default-light mr-2"
                                    style="cursor: default;">Clarifications</a>
                            </div>
                        @endif
                    </td>

                    <td>
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false"><i class="fas fa-ellipsis-v ellipse_color"></i></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

                                <a class="dropdown-item"
                                    href="{{ route('evaluations.pdf', ['evaluation' => $evaluation->id]) }}">Generate
                                    PDF</a>
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
                                @if (Auth::user()->role_id == 3 && ($evaluation->status == 2 || $evaluation->status == 3))
                                    <a class="dropdown-item" wire:click="approveEvaluation({{ $evaluation->id }})">
                                        Mark as pending</a>
                                @endif

                                @if ($evaluation->evaluator_id == Auth::user()->employee_id)
                                    <a class="dropdown-item"
                                        href="{{ route('evaluations.edit', ['evaluation' => $evaluation->id]) }}">
                                        View evaluation
                                    </a>
                                @endif

                                @if ($evaluation->evaluator_id == Auth::user()->employee_id)
                                    @if ($evaluation->status === 1)
                                        <a class="dropdown-item"
                                            onclick="confirmDeleteEvaluation({{ $evaluation->id }})">
                                            Delete
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">
        {{ $evaluations->links() }}
    </div>
    {{-- {{ $evaluations->links('pagination::bootstrap-4') }} --}}


</div>
