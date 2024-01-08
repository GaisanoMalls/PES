@extends('layouts.app')

@section('content')
    <div>
        <div class="m-t-50">
            <h4>List of Recommended Employees</h4>
            <a href="{{ route('reports.recommended.download.excel') }}" class="btn btn-success">Download Excel</a>
            <a href="{{ route('reports.recommended.download.pdf') }}" class="btn btn-info">Download PDF</a>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="table-responsive">
                            <div class="datatable table table-bordered">
                                <table id="employees-table" class="table table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Employee ID</th>
                                            <th>Department</th>
                                            <th>Employee Name</th>
                                            <th>Position</th>
                                            <th>Recommendation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employeesWithRecommendations as $employee)
                                            <tr class="text-center">
                                                <td>{{ $employee->employee_id }}</td>
                                                <td>{{ $employee->department->name }}</td>
                                                <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                                <td>{{ $employee->position }}</td>
                                                <td>{{ $employee->recommendations_count }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{ $employeesWithRecommendations->links() }} <!-- This will render the pagination links -->
        </div>
    </div>
@endsection
