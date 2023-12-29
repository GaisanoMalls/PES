@extends('layouts.app')

@section('content')
    <div class="m-t-30">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Evaluation Permission Details</h3>
                    </div>
                    <div class="card-body">
                        <h6>Employee Name:
                            {{ $evaluationPermissions->first()->employee->first_name . ' ' . $evaluationPermissions->first()->employee->last_name }}
                        </h6>
                        <h6>Employee ID: {{ $evaluationPermissions->first()->employee->employee_id }}</h6>
                        <table class="table bg-white table-bordered">
                            <thead>
                                <tr>
                                    <th>Department</th>
                                    <th>Branch</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($evaluationPermissions as $permission)
                                    <tr>
                                        <td>{{ $permission->department->name }}</td>
                                        <td>{{ $permission->branch->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('settings.evalpermShow', ['id' => $evaluationPermissions->first()->employee_id]) }}"
                            class="btn btn-success m-t-15 m-l-15">Edit</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
