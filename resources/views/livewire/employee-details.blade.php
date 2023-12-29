<div>

    <div class="profile-header">
        <h3>Employee Details</h3>

        <div class="row align-items-center">
            <div class="col-auto profile-image">
                <a href="#"> <img class="rounded-circle" alt="User Image"
                        src=" {{ asset('assets/img/profiles/avatar.png') }}">

                </a>
            </div>
            <div class="col ml-md-n2 profile-user-info">
                <h4 class="user-name mb-3">Name: {{ $employee->first_name . ' ' . $employee->last_name }}</h4>
                <h5 class="text-muted mt-1">Employee ID: <strong>{{ $employee->employee_id }}</strong></h5>
                <h5 class="text-muted mt-1">Department: <strong>{{ $employee->department->name }}</strong></h5>
                <h5 class="text-muted mt-1">Position: <strong>{{ $employee->position }}</strong></h5>
                <h5 class="text-muted mt-1">Date Hired: <strong>{{ $employee->date_hired }}</strong></h5>

            </div>
            @if (Auth::user()->role_id == 2)
                <div class="col-auto profile-btn"> <a
                        href="{{ route('evaluations.select', ['employeeId' => $employee->id]) }}"
                        class="btn btn-primary mb-3">
                        Evaluate Employee
                    </a>
                </div>
            @endif
            @if (Auth::user()->role_id == 5 || Auth::user()->role_id == 1)
                <div class="col-auto profile-btn"> <a href="{{ route('employees.edit', $employee->id) }}"
                        class="btn btn-primary mb-3">
                        Edit Employee
                    </a>
                </div>
            @endif

        </div>

    </div>

    <div class="m-t-20">
        <h3 class="m-l-15">Evaluations</h3>
        <!-- Add Evaluate Employee button here -->

        <table class="table bg-white table-hover table-bordered">
            <thead>
                <tr class="text-center">
                    <th>Evaluation ID</th>
                    <th>Score</th>
                    <th>Recomemndations</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($evaluations as $evaluation)
                    <tr class="text-center">
                        <td>{{ $evaluation->id }}</td>
                        <td>{{ $evaluationTotals[$evaluation->id] }}</td>
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
                                <span class="btn-sm bg-default-light mr-2" style="cursor: default;">Pending</span>
                            @elseif($evaluation->status == 2)
                                <span class="btn-sm bg-success-light mr-2" style="cursor: default;">Approved</span>
                            @elseif($evaluation->status == 3)
                                <span class="btn-sm bg-danger-light mr-2" style="cursor: default;">Disapproved</span>
                            @elseif($evaluation->status == 4)
                                <span class="btn-sm bg-default-light mr-2"
                                    style="cursor: default;">Clarifications</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($evaluation->created_at)->format('F d, Y g:i A') }}</td>

                        <th> <a class="btn btn-outline-secondary"
                                onclick="redirectToEvaluation('{{ $evaluation->id }}', '{{ Auth::user()->role_id }}')">Show</a>
                            <script>
                                function redirectToEvaluation(evaluationId, userRoleId) {
                                    var baseUrl = '/evaluations';

                                    if (userRoleId == 2 || userRoleId == 5) {
                                        window.location.href = baseUrl + '/view/' + evaluationId;
                                    } else if (userRoleId == 3 || userRoleId == 4) {
                                        window.location.href = baseUrl + '/review/' + evaluationId;
                                    }
                                }
                            </script>
                        </th>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">No data available</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>
