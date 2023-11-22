<div>
    <div class="">

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="table-responsive">
                        <div class="datatable table table-stripped">

                            <table id="employees-table" class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th>EmployeeID </th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Position</th>
                                        <th>Date Hired</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if ($employees->count() > 0)
                                        @foreach ($employees as $employee)
                                            <tr class="text-center">
                                                <td>{{ $employee->employee_id }}</td>
                                                <td>{{ $employee->first_name . ' ' . $employee->last_name }}</td>
                                                <td>{{ $employee->department->name }}</td>
                                                <td>{{ $employee->position }}</td>
                                                <td>{{ \Carbon\Carbon::parse($employee->date_hired)->format('F d, Y') }}
                                                </td>
                                                <td>
                                                    @if ($employee->is_active == 1)
                                                        <div class="actions">
                                                            <a href="#"
                                                                class="btn btn-sm bg-success-light mr-2">Active</a>
                                                        </div>
                                                    @elseif ($employee->is_active == 2)
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
                                                                <a class="dropdown-item"
                                                                    href="{{ route('employees.show', ['employee_id' => $employee->employee_id]) }}">Edit
                                                                    user</a>
                                                            </div>
                                                        </div>
                                                    @elseif(Auth::user()->role_id != 4)
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="action-icon dropdown-toggle"
                                                                data-toggle="dropdown" aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-v ellipse_color"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-right"
                                                                aria-labelledby="dropdownMenuButton">
                                                                @foreach ($evaluationTemplates as $template)
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('evaluations.create', ['employee' => $employee->id, 'template' => $template->id, 'templateName' => $template->name]) }}"
                                                                        data-template-name="{{ $template->name }}"
                                                                        data-template-id="{{ $template->id }}">{{ $template->name }}</a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">No matching employees found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ $employees->links() }}
    </div>
</div>
