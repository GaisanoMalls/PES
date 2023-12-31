<!-- resources/views/livewire/evaluations-table.blade.php -->
<div class="m-t-30 p-t-10">
    <div class="col-md-3 m-t-15">
        <h3>Employees Evaluation</h3>
    </div>
    <div class="text-right">

        @if ($userRoleId == 2)
            <button wire:click="toggleShowAllEvaluations" class="btn btn-success mb-3 mr-2">
                {{ $showAllEvaluations ? 'View My Evaluations' : 'View All Evaluations' }}
            </button>
        @endif

    </div>
    <div class="row formtype">

        <div class="col-md-2">
            <div class="form-group">
                <label>Employee ID - Name</label>
                <input wire:model.debounce.300ms="searchName" type="text" class="form-control mb-3"
                    placeholder="Search Employee">
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
                <label>Branch</label>
                <select wire:model.debounce.300ms="branchFilter" class="form-control">
                    <option value="">All</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
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
                    @if (auth()->user()->role_id == 5)
                        <option value="All">All</option>
                        <option value="2">Approved</option>
                        <option value="5">Processed</option>
                    @else
                        <option value="All">All</option>
                        <option value="1">Pending</option>
                        <option value="2">Approved</option>
                        <option value="3">Disapproved</option>
                        <option value="4">Clarifications</option>
                        <option value="5">Processed</option>
                    @endif
                </select>
            </div>
        </div>


        <div class="col-md-2">
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
                <th>Branch</th>
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

            @forelse ($evaluations as $evaluation)
                @if ($userRoleId == 5 && $evaluation->status != 5 && $evaluation->status != 2)
                    @continue
                @endif
                <tr class="text-center">
                    <td>{{ $evaluation->employee->employee_id }}</td>
                    <td>{{ $evaluation->employee->last_name . ', ' . $evaluation->employee->first_name }}</td>
                    <td>{{ $evaluation->employee->department->name }}</td>
                    <td>{{ $evaluation->employee->branch->name }}</td>

                    <td>{{ \Carbon\Carbon::parse($evaluation->created_at)->format('F d, Y') }}</td>
                    <td>{{ $evaluationTotals[$evaluation->id] }}</td>
                    <td>{{ substr($evaluation->recommendation_note, 0, 50) }}</td>
                    <td>{{ substr($evaluation->ratees_comment, 0, 50) }}</td>
                    <td>{{ $evaluation->evaluatorEmployee->first_name }}
                        {{ $evaluation->evaluatorEmployee->last_name }}
                    </td>
                    <td>
                        @if (\App\Models\Recommendation::where('evaluation_id', $evaluation->id)->exists())
                            <a href="#" class="btn btn-sm bg-success-light mr-2" style="cursor: default;">
                                Yes</a>
                        @else
                            <a href="#" class="btn btn-sm bg-default-light mr-2" style="cursor: default;">
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
                                    wire:click="proccessedEvaluation({{ $evaluation->id }})"
                                    wire:loading.attr="disabled" wire:target="proccessedEvaluation">
                                    <span wire:loading wire:target="proccessedEvaluation"
                                        class="spinner-border spinner-border-sm mr-2"></span>
                                    Approved
                                </a>
                            </div>
                        @elseif($evaluation->status == 3)
                            <div class="actions">
                                <a href="#" class="btn btn-sm bg-danger-light mr-2"
                                    style="cursor: default;">Disapproved</a>
                            </div>
                        @elseif($evaluation->status == 4)
                            <div class="actions">
                                <a href="#" class="btn btn-sm bg-warning-light mr-2"
                                    style="cursor: default;">Clarifications</a>
                            </div>
                        @elseif($evaluation->status == 5)
                            <div class="actions">
                                <a href="#" class="btn btn-sm bg-success-light2 mr-2"
                                    style="cursor: default;">Processed</a>
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
                                        (Auth::user()->role_id == 3 && $evaluation->status == 4) ||
                                        (Auth::user()->role_id == 5 && $evaluation->status == 2) ||
                                        (Auth::user()->role_id == 3 && $evaluation->status == 2) ||
                                        (Auth::user()->role_id == 3 && $evaluation->status == 3))
                                    <a class="dropdown-item"
                                        href="{{ route('evaluations.review', ['evaluation' => $evaluation->id]) }}">
                                        Review
                                    </a>
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
                                @if (Auth::user()->role_id == 5 && $evaluation->status == 2)
                                    <a class="dropdown-item"
                                        wire:click="proccessedEvaluation('{{ $evaluation->id }}')">
                                        Processed
                                    </a>
                                @endif
                                @if (Auth::user()->role_id == 5 && $evaluation->status == 5)
                                    <a class="dropdown-item"
                                        wire:click="unproccessedEvaluation({{ $evaluation->id }})">
                                        Unprocess
                                    </a>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">No data available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-3">
        {{ $evaluations->links() }}
    </div>
    {{-- {{ $evaluations->links('pagination::bootstrap-4') }} --}}


</div>
