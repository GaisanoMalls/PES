@extends('layouts.app')

@section('content')
    <div>
        <div class="m-t-50">
            <h4>List of Evaluated Employees</h4>
            <a href="{{ route('reports.evaluation.download.excel') }}" class="btn btn-success">Download Excel</a>
            <a href="{{ route('reports.listevaluated.download.pdf') }}" class="btn btn-info">Download PDF</a>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="table-responsive">
                            <div class="datatable table table-stripped">
                                <table id="evaluation-templates" class="table table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Employee ID</th>
                                            <th>Employee Name</th>
                                            <th>Department</th>
                                            <th>Branch</th>
                                            <th>Total Rate</th>
                                            <th>Evaluated By</th>
                                            <th>Recommendations</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($evaluations as $evaluation)
                                            <tr class="text-center">
                                                <td>{{ $evaluation->employee->employee_id }}</td>
                                                <td>{{ $evaluation->employee->last_name . ', ' . $evaluation->employee->first_name }}
                                                </td>
                                                <td>{{ $evaluation->employee->department->name }}</td>
                                                <td>{{ $evaluation->employee->branch->name }}</td>
                                                <td>{{ $evaluationTotals[$evaluation->id] }}</td>
                                                <td>{{ $evaluation->evaluatorEmployee->first_name }}
                                                    {{ $evaluation->evaluatorEmployee->last_name }}
                                                </td>
                                                <td>
                                                    @if (\App\Models\Recommendation::where('evaluation_id', $evaluation->id)->exists())
                                                        <a href="#" class="btn btn-sm bg-success-light mr-2"
                                                            style="cursor: default;">
                                                            Yes</a>
                                                    @else
                                                        <a href="#" class="btn btn-sm bg-default-light mr-2"
                                                            style="cursor: default;">
                                                            No</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($evaluation->status == 1)
                                                        <div class="actions">
                                                            <a href="#" class="btn-sm bg-default-light mr-2"
                                                                style="cursor: default;">Pending</a>
                                                        </div>
                                                    @elseif($evaluation->status == 2)
                                                        <div class="actions">
                                                            <a href="#" class="btn btn-sm bg-success-light mr-2"
                                                                wire:click="proccessedEvaluation({{ $evaluation->id }})"
                                                                wire:loading.attr="disabled"
                                                                wire:target="proccessedEvaluation">
                                                                <span wire:loading wire:target="proccessedEvaluation"
                                                                    class="spinner-border spinner-border-sm mr-2"></span>
                                                                Approved
                                                            </a>
                                                        </div>
                                                    @elseif($evaluation->status == 3)
                                                        <div class="actions">
                                                            <a href="#" class="btn btn-sm bg-danger-light mr-2"
                                                                style="cursor: default;">Disapproved</a>
                                                        </div>
                                                    @elseif($evaluation->status == 4)
                                                        <div class="actions">
                                                            <a href="#" class="btn btn-sm bg-warning-light mr-2"
                                                                style="cursor: default;">Clarifications</a>
                                                        </div>
                                                    @elseif($evaluation->status == 5)
                                                        <div class="actions">
                                                            <a href="#" class="btn btn-sm bg-success-light2 mr-2"
                                                                style="cursor: default;">Processed</a>
                                                        </div>
                                                    @endif
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
            {{ $evaluations->links() }} <!-- This will render the pagination links -->
        </div>
    </div>
@endsection
