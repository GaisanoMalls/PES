@extends('layouts.app')

@section('content')
    <div class="">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-2">
                        <h4 class="card-title float-left mt-2">Recommended Employees</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="table-responsive">
                        <div class="datatable table table-stripped">
                            <table id="evaluation-templates" class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th><a class="text-black">Evaluation ID</a></th>
                                        <th><a class="text-black">
                                                Employee Name</a></th>
                                        <th class="text-center text-black">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($evaluations as $evaluation)
                                        <tr class="text-center">
                                            <td>{{ $evaluation->id }}</td>
                                            <td>{{ $evaluation->employee->first_name . ' ' . $evaluation->employee->last_name }}
                                            </td>
                                            <td class="text-center">

                                            </td>
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
@endsection
