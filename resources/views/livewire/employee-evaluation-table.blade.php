<div>
    <table class="table bg-white table-active table-bordered">
        <thead>
            <tr class="text-center">
                <th>Employee ID</th>
                <th>Department Name</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Position</th>
                <th>Evaluations (Total)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr class="text-center">
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->department->name }}</td>
                    <td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
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
</div>
