<div class="m-t-30 p-t-10">
    <div class="col-md-3 m-t-15">
        <h1>Evaluations</h1>
    </div>
    <div class="row formtype">

        <div class="col-md-3">
            <div class="form-group">
                <label>Employee ID - Name</label>
                <input wire:model.debounce.300ms="searchName" type="text" class="form-control mb-3"
                    placeholder="Search by Employee ID/Name">
            </div>
        </div>
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
    <table class="table bg-white table-active table-bordered">
        <thead>
            <tr class="text-center">
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Department</th>
                <th>Position</th>
                <th>Evaluations (Total)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr class="text-center">
                    <td>{{ $employee->employee_id }}</td>
                    <td>{{ $employee->last_name . ', ' . $employee->first_name }}</td>
                    <td>{{ $employee->department->name }}</td>
                    <td>{{ $employee->position }}</td>
                    <td>{{ $employee->evaluations->count() }}</td>
                    <td>
                        <a href="{{ route('employees.evaluations-view', ['employee_id' => $employee->id]) }}"
                            class="btn btn-outline-secondary">Show</a>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">
        {{ $employees->links() }}
    </div>
</div>
