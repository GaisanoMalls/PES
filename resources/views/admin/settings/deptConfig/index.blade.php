@extends('layouts.app')

@section('content')
    <div class="m-t-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Department Configurations</h3>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <a href="{{ route('settings.deptconfigCreate') }}" class="btn btn-primary">Create Department
                                Configuration</a>
                        </div>
                        <table class="table bg-white table-active table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Number of Approvers</th>
                                    <th>Department Name</th>
                                    <th>Branch Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departmentConfigurations as $config)
                                    <tr class="text-center">
                                        <td>{{ $config->id }}</td>
                                        <td>{{ $config->number_of_approvers }}</td>
                                        <td>{{ $config->department->name }}</td>
                                        <td>{{ $config->branch->name }}</td>

                                        <td>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i
                                                        class="fas fa-ellipsis-v ellipse_color"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                    aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item"
                                                        href="{{ route('settings.deptconfigEdit', ['id' => $config->id]) }}">Show</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
