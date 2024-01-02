<div>
    <div class="m-t-30 p-t-10">
        <div class="col-md-3 m-t-15">
            <h3>Employees Evaluation</h3>
        </div>
        <div class="row formtype">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Employee ID - Name</label>
                    <input wire:model="searchName" type="text" class="form-control mb-3"
                        placeholder="Search by Employee ID/Name">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Department</label>
                    <select wire:model="departmentFilter" class="form-control">
                        <option value="">All</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-md-2">
                <div class="form-group">
                    <label>Branch</label>
                    <select wire:model="branchFilter" class="form-control">
                        <option value="">All</option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Employment Status</label>
                    <select wire:model="employmentStatusFilter" class="form-control">
                        <option value="">All</option>
                        @foreach ($employmentStatuses as $status)
                            <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Search</label>
                    <button wire:click="search" class="btn btn-outline-success btn-block mt-0">
                        Search
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="table-responsive">
                        <div class="datatable table table-bordered">
                            <table id="employees-table" class="table table-hover">
                                <thead>
                                    <tr class="">
                                        <th>Employee ID </th>
                                        <th>Department</th>
                                        <th>Branch</th>
                                        <th>Last Name</th>
                                        <th>First Name</th>
                                        <th>Position</th>
                                        <th>Employement Status</th>
                                        <th>Date Hired</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if ($employees->count() > 0)
                                        @foreach ($employees as $employee)
                                            <tr class="">
                                                <td>{{ $employee->employee_id }}</td>
                                                <td>{{ $employee->department->name }}</td>
                                                <td>{{ $employee->branch->name }}</td>
                                                <td>{{ $employee->last_name }}</td>

                                                <td>{{ $employee->first_name }}</td>
                                                <td>{{ $employee->position }}</td>
                                                <td>{{ $employee->employment_status }}</td>
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
                                                        <a href="{{ route('employees.show', ['employee_id' => $employee->employee_id]) }}"
                                                            class="btn btn-outline-success">Show</a>
                                                    @elseif(Auth::user()->role_id == 2)
                                                        <a href="{{ route('evaluations.select', ['employeeId' => $employee->employee_id]) }}"
                                                            class="btn btn-outline-success">Evaluate</a>
                                                    @endif
                                                    <a href="{{ route('employees.evaluations-view', ['employee_id' => $employee->employee_id]) }}"
                                                        class="btn btn-outline-success">View</a>

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
