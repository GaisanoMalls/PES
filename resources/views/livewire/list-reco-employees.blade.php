<div>
    <div class="m-t-50">
        <h4>List of Recommended Employees</h4>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="table-responsive">
                        <div class="datatable table table-stripped">
                            <table id="evaluation-templates" class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th><a class="text-black">Employee ID</a></th>
                                        <th><a class="text-black">Department</a></th>
                                        <th><a class="text-black">Employee Name</a></th>
                                        <th><a class="text-black">Position</a></th>
                                        <th><a class="text-black">Recommendation</a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employeesWithRecommendations as $employee)
                                        <tr class="text-center">
                                            <td>{{ $employee->employee_id }}</td>
                                            <td>{{ $employee->department->name }}</td>
                                            <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                            <td>{{ $employee->position }}</td>
                                            <td>{{ $employee->recommendations_count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
