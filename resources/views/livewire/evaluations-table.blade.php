<!-- resources/views/livewire/evaluations-table.blade.php -->

<div class="m-t-30">
    <h1>Evaluations</h1>
    <!-- Button to toggle between all evaluations and user's evaluations -->
    <button wire:click="toggleShowAllEvaluations" class="btn btn-primary mb-3">
        {{ $showAllEvaluations ? 'View My Evaluations' : 'View All Evaluations' }}
    </button>
    <table class="table">
        <thead>
            <tr class="text-center">
                <th>ID</th>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Date of Evaluation</th>
                <th>Total Rate</th>
                <th>Recommendation Note</th>
                <th>Ratees comment</th>

                <th>Evaluated By</th>
                <th>Status</th>

                @if (Auth::user()->role_id != 4)
                    <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($evaluations as $evaluation)
                <tr class="text-center">
                    <td>{{ $evaluation->id }}</td>
                    <td>{{ $evaluation->employee->employee_id }}</td>
                    <td>{{ $evaluation->employee->first_name . ' ' . $evaluation->employee->last_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($evaluation->created_at)->format('F d, Y') }}</td>
                    <td>{{ $evaluationTotals[$evaluation->id] }}</td>
                    <td>{{ $evaluation->recommendation_note }}</td>
                    <td>{{ $evaluation->ratees_comment }}</td>
                    <td>{{ $evaluation->evaluatorEmployee->first_name }} {{ $evaluation->evaluatorEmployee->last_name }}
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
                        @endif
                    </td>

                    <td>
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false"><i class="fas fa-ellipsis-v ellipse_color"></i></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                @if ($evaluation->status == 1)
                                    <a class="dropdown-item"
                                        href="{{ route('evaluations.review', ['evaluation' => $evaluation->id]) }}">
                                        Review
                                    </a>
                                @elseif($evaluation->status == 2 || $evaluation->status == 3)
                                    <a class="dropdown-item"
                                        href="{{ route('evaluations.review', ['evaluation' => $evaluation->id]) }}">
                                        Edit
                                    </a>
                                @endif
                                @if (Auth::user()->role_id != 4)
                                    <a class="dropdown-item"
                                        href="{{ route('evaluations.pdf', ['evaluation' => $evaluation->id]) }}">Generate
                                        PDF</a>
                                @endif
                                @if ($evaluation->status == 2 || $evaluation->status == 3)
                                    <a class="dropdown-item" wire:click="approveEvaluation({{ $evaluation->id }})">
                                        Mark as pending</a>
                                @endif
                                <a class="dropdown-item"
                                    href="{{ route('evaluations.edit', ['evaluation' => $evaluation->id]) }}">
                                    Edit evaluation
                                </a>

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
