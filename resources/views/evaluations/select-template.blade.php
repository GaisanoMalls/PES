@extends('layouts.app')

@section('content')
    <div class="bg-white2 m-t-30">
        <div class="d-flex justify-content-center align-items-center">
            <div class="col-md-5 text-center m-t-20">
                <h2>Select an Evaluation Template</h2>

                <div class="form-group">


                    <select class="form-control form-control-lg mb-3" name="template" id="template">
                        <option>--Select--</option>
                        @foreach ($evaluationTemplates as $template)
                            <option value="{{ $template->id }}">{{ $template->name }}</option>
                        @endforeach
                    </select>
                    <a class="btn btn-success btn-block mt-3" id="continueButton" href="#">Continue</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('continueButton').addEventListener('click', function() {
            var templateId = document.getElementById('template').value;
            var employeeId = '{{ $employee->employee_id }}'; // Assuming you have access to the employee ID

            if (templateId !== "--Select--") {
                var url = '/evaluations/create/' + employeeId + '/' + templateId;
                window.location.href = url;
            }
        });
    </script>
@endsection
