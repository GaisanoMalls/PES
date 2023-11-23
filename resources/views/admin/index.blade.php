@extends('layouts.app')

@section('content')
    <div class="">

        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('users.index') }}" method="GET">
                    <div class="row formtype">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>User ID</label>
                                <input type="text" name="search_id" class="form-control" id="search_id"
                                    placeholder="Search by User ID" />
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group search-bar">
                                <label for="search">User Name</label>
                                <input type="text" name="search" class="form-control" id="search"
                                    placeholder="Search users">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Search</label>
                                <button type="submit" class="btn btn-success btn-block mt-0 search_button">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="table-responsive">
                        <div class="datatable table table-stripped">
                            <table id="users-table" class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th><a class="text-black">User
                                                ID</a></th>
                                        <th><a class="text-black">Employee
                                                ID</a></th>
                                        <th><a class="text-black">
                                                Name</a></th>
                                        <th><a class="text-black">
                                                Email</a></th>
                                        <th><a class="text-black">
                                                Role</a></th>
                                        <th class="text-black">Status</th>
                                        <th class="text-right text-black">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if ($users->count() > 0)
                                        @foreach ($users as $user)
                                            <tr class="text-center">
                                                <td>{{ $user->id }}</td>
                                                <td>
                                                    @if ($user->role_id === 1)
                                                        <span><strong>Hidden</strong></span>
                                                    @else
                                                        {{ $user->employee ? $user->employee->employee_id : 'N/A' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($user->role_id === 1)
                                                        <span><strong>Hidden</strong></span>
                                                    @else
                                                        {{ $user->employee ? $user->employee->first_name . ' ' . $user->employee->last_name : 'N/A' }}
                                                    @endif
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role->name }}</td>
                                                <td>
                                                    @if ($user->is_active == 1)
                                                        <div class="actions">
                                                            <a href="#"
                                                                class="btn btn-sm bg-success-light mr-2">Active</a>
                                                        </div>
                                                    @elseif ($user->is_active == 2)
                                                        <div class="actions">
                                                            <a href="#"
                                                                class="btn btn-sm bg-danger-light mr-2">Inactive</a>
                                                        </div>
                                                    @else
                                                        <div class="actions">
                                                            <a href="#"
                                                                class="btn btn-sm bg-success-default mr-2">Unknown</a>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (Auth::user()->role_id == 1)
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="action-icon dropdown-toggle"
                                                                data-toggle="dropdown" aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-v ellipse_color"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-right"
                                                                aria-labelledby="dropdownMenuButton">
                                                                <a href="{{ route('user.show', ['id' => $user->id]) }}"
                                                                    class="dropdown-item">Manage User</a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">No matching users found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
