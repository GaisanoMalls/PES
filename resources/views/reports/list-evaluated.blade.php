@extends('layouts.app')

@section('content')
    <div>
        <div class="m-t-50">
            <h4>List of Evaluated Employees</h4>
            <a href="{{ route('reports.listevaluated.download.excel') }}" class="btn btn-success">Download Excel</a>
            <a href="{{ route('reports.listevaluated.download.pdf') }}" class="btn btn-info">Download PDF</a>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="table-responsive">
                            <div class="datatable table table-stripped">
                                <table id="evaluation-templates" class="table table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Employee ID</th>
                                            <th>Department</th>
                                            <th>Branch</th>
                                            <th>Employee Name</th>
                                            <th>Position</th>
                                            <th>Evaluations</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employeesEvaluated as $employee)
                                            <tr class="text-center">
                                                <td>{{ $employee->employee_id }}</td>
                                                <td>{{ $employee->department->name }}</td>
                                                <td>{{ $employee->branch->name }}</td>
                                                <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                                <td>{{ $employee->position }}</td>
                                                <td>{{ $employee->evaluations_count }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ $employeesEvaluated->links() }} <!-- This will render the pagination links -->

        </div>
    </div>
@endsection
