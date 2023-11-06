<table>
    <thead>
        <tr>
            <th>Employee ID</th>
            <th>Name</th>
            <th>Department</th>
            <th>Position</th>
            <th>Status</th>
            <th>Date Hired</th>
            <th class="text-right">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employees as $employee)
            <tr>
                <td>{{ $employee->employee_id }}</td>
                <td>{{ $employee->first_name . ' ' . $employee->last_name }}</td>
                <td>{{ $employee->department->name }}</td>
                <td>{{ $employee->position }}</td>
                <td>
                    @if ($employee->is_active == 1)
                        <!-- ... your code for status -->
                    @elseif ($employee->is_active == 2)
                        <!-- ... your code for status -->
                    @else
                        <!-- ... your code for status -->
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($employee->join_date)->format('F d, Y') }}</td>
                <td>
                    <div class="dropdown dropdown-action">
                        <!-- ... your dropdown actions here -->
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $employees->links() }} <!-- Display pagination links -->
