@extends('layouts.app')

@section('content')
    <div class="">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
                        <h4 class="card-title float-left mt-2">Templates</h4>
                        <a href="{{ route('templates.create') }}" class="btn btn-primary float-right veiwbutton">Create
                            Template</a>
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
                                        <th><a class="text-black">Template
                                                ID</a></th>
                                        <th><a class="text-black">
                                                Name</a></th>
                                        <th><a class="text-black">
                                                Created At</a></th>
                                        <th class="text-center text-black">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($evaluationTemplates as $template)
                                        <tr class="text-center">
                                            <td>{{ $template->id }}</td>
                                            <td>{{ $template->name }}</td>
                                            <td>{{ $template->created_at }}</td>
                                            <td class="text-center">

                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><i
                                                            class="fas fa-ellipsis-v ellipse_color"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                        aria-labelledby="dropdownMenuButton">

                                                        <a class="dropdown-item"
                                                            href="{{ route('templates.edit', $template->id) }}">
                                                            @csrf
                                                            Edit
                                                        </a>
                                                        <a class="dropdown-item"
                                                            onclick="return confirm('Are you sure you want to delete this template?')"
                                                            href="{{ route('templates.destroy', $template->id) }}">
                                                            @csrf
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
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