<div style="width: 50%; margin: auto;">
    <p>Employee ID: {{ $employeeId }}</p>
    @if ($evaluationPermissions->count() > 0)
        <p>Employee Name: {{ $evaluationPermissions[0]->employee->first_name }}
            {{ $evaluationPermissions[0]->employee->last_name }}</p>

        <table class="table bg-white table-bordered">
            <thead>
                <tr>
                    <th>Department Name</th>
                    <th>Branch Name</th>
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
    @else
        <p>No evaluation permissions found for this employee.</p>
    @endif
</div>
