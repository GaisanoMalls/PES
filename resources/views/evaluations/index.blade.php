@extends('layouts.app')

@section('content')
    <div class="m-t-30">

        <h1>Evaluations</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee ID</th>
                    <th>Date of Evaluation</th>
                    <th>Total Rate</th>
                    <th>Ratee Performance Level</th>
                    <th>Remarks</th>
                    <th>created_at</th>
                    <th>Download</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($evaluations as $evaluation)
                    <tr>
                        <td>{{ $evaluation->id }}</td>
                        <td>{{ $evaluation->employee->employee_id }}</td>
                        <td>{{ \Carbon\Carbon::parse($evaluation->date_of_evaluation)->format('F d, Y') }}</td>
                        <td>{{ $evaluation->total_rate }}</td>
                        <td>{{ $evaluation->recommendation_note }}</td>
                        <td>{{ $evaluation->ratees_comment }}</td>
                        <td>{{ $evaluation->status }}</td>
                        <td>{{ $evaluation->created_at }}</td>
                        <td>{{ $evaluation->updated_at }}</td>

                        {{-- <td>{{ $evaluation->updated_at-> }}</td> --}}
                        <td>
                            <a href="{{ route('evaluations.pdf', ['evaluation' => $evaluation->id]) }}">Generate PDF</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
