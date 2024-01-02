<div class="m-t-30 p-t-10">
    <div class="col-md-3 m-t-15">
        <h3>Evaluations</h3>
    </div>
    <div class="row formtype">

        <div class="col-md-3">
            <div class="form-group">
                <label>Employee ID - Name</label>
                <input wire:model.debounce.300ms="searchName" type="text" class="form-control mb-3"
                    placeholder="Search by Employee ID/Name">
            </div>
        </div>
        {{-- @if (Auth::user()->role_id != 2) --}}
        <div class="col-md-2">
            <div class="form-group">
                <label>Department</label>
                <select wire:model.debounce.300ms="departmentFilter" class="form-control">
                    <option value="">All</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        {{-- @endif --}}
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


        <div class="col-md-3">
            <div class="form-group">
                <label>Search</label>
                <!-- Add search button -->
                <button wire:click="search" class="btn btn-outline-success btn-block mt-0">
                    Search
                </button>
            </div>
        </div>

    </div>

    <div class="card card-table">
        <div class="table-responsive">
            <div class="datatable table table-bordered">

                <table class="table bg-white table-hover table-bordered">
                    <thead>
                        <tr class="">
                            <th>Employee ID</th>
                            <th>Department</th>
                            <th>Branch</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Position</th>
                            <th>Latest Evaluation Date</th>
                            <th>Evaluations (Total)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $employee)
                            <tr class="">
                                <td>{{ $employee->employee_id }}</td>
                                <td>{{ $employee->department->name }}</td>
                                <td>{{ $employee->branch->name }}</td>
                                <td>{{ $employee->last_name }}</td>
                                <td>{{ $employee->first_name }}</td>
                                <td>{{ $employee->position }}</td>
                                <td>{{ $latestEvaluationDates[$employee->employee_id] }}</td>
                                <td>{{ $employee->evaluations->count() }}</td>
                                <td>
                                    <a href="{{ route('employees.evaluations-view', ['employee_id' => $employee->employee_id]) }}"
                                        class="btn btn-outline-secondary">Show</a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
