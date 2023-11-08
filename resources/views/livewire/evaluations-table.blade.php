<!-- resources/views/livewire/evaluations-table.blade.php -->

<div class="m-t-30">
    <h1>Evaluations</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Date of Evaluation</th>
                <th>Total Rate</th>
                <th>Recommendation Note</th>
                <th>Ratees comment</th>
                <th>Status</th>
                <th>Evaluated By</th>
                <th>Download</th>
                @if (Auth::user()->role_id != 4)
                    <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($evaluations as $evaluation)
                <tr>
                    <td>{{ $evaluation->id }}</td>
                    <td>{{ $evaluation->employee->employee_id }}</td>
                    <td>{{ $evaluation->employee->first_name . ' ' . $evaluation->employee->last_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($evaluation->date_of_evaluation)->format('F d, Y') }}</td>
                    <td>{{ $evaluationTotals[$evaluation->id] }}</td>
                    <td>{{ $evaluation->recommendation_note }}</td>
                    <td>{{ $evaluation->ratees_comment }}</td>
                    <td>
                        @if ($evaluation->status == 1)
                            Pending
                        @elseif($evaluation->status == 2)
                            Approved
                        @endif
                    </td>
                    <td>{{ $evaluation->evaluatorEmployee->first_name }} {{ $evaluation->evaluatorEmployee->last_name }}
                    </td>
                    <td>
                        @if (Auth::user()->role_id != 4)
                            <a href="{{ route('evaluations.pdf', ['evaluation' => $evaluation->id]) }}">Generate PDF</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('evaluations.review', ['evaluation' => $evaluation->id]) }}"
                            class="btn btn-success">Review</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
