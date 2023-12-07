@extends('layouts.app')

@section('content')
    <!-- resources/views/livewire/evaluations-table.blade.php -->
    <div class="m-t-50">

        <h4>List of Recommended Employees</h4>

        {{-- <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Select Date Range</label>
                    <select class="form-control" id="dateRangeSelector" name="dateRangeSelector">
                        <option value="default">Select Date Range</option>
                        <option value="7">Last 7 Days</option>
                        <option value="30">Last 30 Days</option>
                        <option value="60">Last 60 Days</option>
                        <option value="custom">Custom</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>From</label>
                    <div class="cal-icon">
                        <input type="date" class="form-control datetimepicker" id="fromDate" />
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>To</label>
                    <div class="cal-icon">
                        <input type="date" class="form-control datetimepicker" id="toDate" />
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Search</label>
                    <a href="#" class="btn btn-success btn-block mt-0 search_button" onclick="searchData()">
                        Search
                    </a>
                </div>
            </div>
        </div> --}}

        {{--
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Export</label>
                    <a href="#" class="btn btn-success btn-block mt-0 search_button">
                        Generate PDF
                    </a>
                </div>
            </div>
        </div> --}}

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
                                    @foreach ($employees as $employee)
                                        <tr class="text-center">
                                            <td>{{ $employee->employee_id }}</td>
                                            <td>{{ $employee->department->name }}</td>
                                            <td>{{ $employee->last_name . ', ' . $employee->first_name }}</td>
                                            <td>{{ $employee->position }}</td>
                                            <td>{{ $employee->recommendation_count }}</td>
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
    <script>
        // Function to set date values based on the selected option
        function setDates() {
            var dateRangeSelector = document.getElementById('dateRangeSelector');
            var fromDateInput = document.getElementById('fromDate');
            var toDateInput = document.getElementById('toDate');

            var today = new Date();
            var fromDate = new Date();

            if (dateRangeSelector.value === 'default') {
                // Disable date inputs
                fromDateInput.disabled = true;
                toDateInput.disabled = true;

            } else if (dateRangeSelector.value === 'custom') {
                // Last 60 Days
                fromDateInput.value = '';
                toDateInput.value = '';
            } else {
                fromDateInput.disabled = false;
                toDateInput.disabled = false;
                if (dateRangeSelector.value === '7') {
                    // Last 7 Days
                    fromDate.setDate(today.getDate() - 7);
                } else if (dateRangeSelector.value === '30') {
                    // Last 30 Days
                    fromDate.setDate(today.getDate() - 30);
                } else if (dateRangeSelector.value === '60') {
                    // Last 60 Days
                    fromDate.setDate(today.getDate() - 60);
                }

                // Set the values of the date inputs
                fromDateInput.valueAsDate = fromDate;
                toDateInput.valueAsDate = today;
            }
        }

        // Function to be called when the search button is clicked
        function searchData() {
            // Perform your search logic here
            // You may want to add an AJAX call to send the selected date range to the server
        }

        // Set initial dates on page load
        setDates();

        // Attach the setDates function to the change event of the date range selector
        document.getElementById('dateRangeSelector').addEventListener('change', setDates);
    </script>
@endsection
