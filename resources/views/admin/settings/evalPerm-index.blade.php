@extends('layouts.app')

@section('content')
    <div class="m-t-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Evaluation Permissions</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{ route('settings.evalpermCreate') }}" class="btn btn-primary">Create Evaluation
                                Permission</a>
                        </div>
                        <table class="table bg-white table-active table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Employee ID</th>
                                    <th>Email</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Actions</th>
                                    <!-- Add more columns as needed -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($evaluationPermissions as $permission)
                                    <tr class="text-center">
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->employee->employee_id }}</td>
                                        <td>{{ $permission->user->email }}</td>
                                        <td>{{ $permission->employee->first_name }}</td>
                                        <td>{{ $permission->employee->last_name }}</td>
                                        <td>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i
                                                        class="fas fa-ellipsis-v ellipse_color"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                    aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item"
                                                        href="{{ route('settings.evalpermEdit', ['id' => $permission->employee->employee_id]) }}">Show</a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
