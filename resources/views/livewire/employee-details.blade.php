<div>
    <h2>Employee Details</h2>

    <p><strong>Employee ID:</strong> {{ $employee->employee_id }}</p>
    <p><strong>Department Name:</strong> {{ $employee->department->name }}</p>
    <p><strong>First Name:</strong> {{ $employee->first_name }}</p>
    <p><strong>Last Name:</strong> {{ $employee->last_name }}</p>
    <p><strong>Position:</strong> {{ $employee->position }}</p>

    <div class="profile-header">
        <div class="row align-items-center">
            <div class="col-auto profile-image">
                <a href="#"> <img class="rounded-circle" alt="User Image" src="assets/img/profiles/avatar-02.jpg">
                </a>
            </div>
            <div class="col ml-md-n2 profile-user-info">
                <h4 class="user-name mb-3"> {{ $employee->first_name . ' ' . $employee->last_name }}</h4>

                <h6 class="text-muted mt-1"> {{ $employee->employee_id }}</h6>
                <h6 class="text-muted mt-1"> {{ $employee->department->name }}</h6>

                <h6 class="text-muted mt-1"> {{ $employee->position }}</h6>
                <div class="user-Location mt-1"><i class="fas fa-map-marker-alt"></i> Florida, United States</div>
                <div class="about-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua.</div>
            </div>
            <div class="col-auto profile-btn"> <a href="" class="btn btn-primary">
                    Message
                </a> <a href="edit-profile.html" class="btn btn-primary">
                    Edit
                </a> </div>
        </div>
    </div>

    <h3>Evaluations</h3>
    <!-- Add Evaluate Employee button here -->
    <a href="{{ route('evaluations.select', ['employeeId' => $employee->id]) }}" class="btn btn-primary mb-3">
        Evaluate Employee
    </a>

    <table class="table bg-white table-active table-bordered">
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
            @foreach ($evaluations as $evaluation)
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
                            <span class="btn-sm bg-default-light mr-2" style="cursor: default;">Clarifications</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($evaluation->created_at)->format('F d, Y') }}</td>

                    <th> <a class="btn btn-outline-secondary"
                            onclick="redirectToEvaluation('{{ $evaluation->id }}', '{{ Auth::user()->role_id }}')">Show</a>
                        <script>
                            function redirectToEvaluation(evaluationId, userRoleId) {
                                var baseUrl = '/evaluations';

                                if (userRoleId == 2 || userRoleId == 5) {
                                    window.location.href = baseUrl + '/view/' + evaluationId;
                                } else if (userRoleId == 3) {
                                    window.location.href = baseUrl + '/' + evaluationId + '/review';
                                }
                            }
                        </script>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
