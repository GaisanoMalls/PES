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

                                        <th class="text-right text-black">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($evaluationTemplates as $template)
                                        <tr class="text-center">
                                            <td>{{ $template->id }}</td>
                                            <td>{{ $template->name }}</td>
                                            <td>{{ $template->created_at }}</td>
                                            <td class="text-right">
                                                <form action="{{ route('templates.edit', $template->id) }}" method="GET">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning">Edit</button>
                                                </form>
                                                <form action="{{ route('templates.destroy', $template->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this template?')">Delete</button>
                                                </form>
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
