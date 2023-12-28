<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EvaluationPermission;
use App\Models\Evaluator;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class Employees extends PowerGridComponent
{
    use WithExport;
    public bool $deferLoading = true; // default false
    public string $loadingComponent = 'components.my-custom-loading';
    public function setUp(): array
    {

        return [

            Header::make()->showSearchInput()->withoutLoading()->includeViewOnBottom('components.header-bottom'),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }


    public function datasource(): Builder
    {
        // Check if the current user is an admin (assuming role_id 1 represents admin)
        if (auth()->user()->role_id === 1 || auth()->user()->role_id === 5) {
            // If admin, return all employees without department filtering
            return Employee::query();
        }

        // If not admin, proceed with the EvaluationPermission-based filtering logic

        // Retrieve the current user's evaluator ID
        $evaluatorId = auth()->user()->id;

        // Join Employee with EvaluationPermission based on evaluator ID
        return Employee::join('evaluation_permissions', function ($join) use ($evaluatorId) {
            $join->on('employees.department_id', '=', 'evaluation_permissions.department_id')
                ->on('employees.branch_id', '=', 'evaluation_permissions.branch_id')
                ->where('evaluation_permissions.evaluator_id', $evaluatorId);
        })
            ->select('employees.*')
            ->distinct();
    }



    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('employee_id')


            ->addColumn('department_name', fn (Employee $model) => $model->department->name)

            ->addColumn('branch_name', fn (Employee $model) => $model->branch->name)

            ->addColumn('first_name')
            ->addColumn('last_name')
            ->addColumn('date_hired')
            ->addColumn('employment_status')
            ->addColumn('position')
            // ->addColumn('employment_status')
            // ->addColumn('is_active', fn (Employee $model) => $model->is_active ? 'Active' : 'Inactive')

            ->addColumn('created_at_formatted', fn (Employee $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [

            Column::make('Employee id', 'employee_id')
                ->searchable(),

            Column::make('Department Name', 'department_name'),


            Column::make('Branch Name', 'branch_name'),

            Column::make('First name', 'first_name')
                ->sortable()
                ->searchable(),

            Column::make('Last name', 'last_name')
                ->sortable()
                ->searchable(),

            Column::make('Position', 'position')
                ->sortable()
                ->searchable(),

            Column::make('Employment Status', 'employment_status')
                ->sortable()
                ->searchable(),

            Column::make('Date hired', 'date_hired')
                ->sortable()
                ->searchable(),

            Column::action('Action'),

        ];
    }

    public function filters(): array
    {
        $evaluatorId = auth()->user()->id;

        // Check if the current user is an admin or a specific role
        if (auth()->user()->role_id === 1 || auth()->user()->role_id === 5) {
            // If admin, fetch all departments and branches
            $allDepartments = Department::all();
            $allBranches = Branch::all();
        } else {
            // If not admin, fetch only relevant departments and branches based on EvaluationPermissions
            // Retrieve the EvaluationPermission records based on the current user's evaluator ID

            // Retrieve unique department and branch IDs from EvaluationPermissions
            $departmentIds = EvaluationPermission::where('evaluator_id', $evaluatorId)
                ->pluck('department_id')
                ->unique()
                ->toArray();

            $branchIds = EvaluationPermission::where('evaluator_id', $evaluatorId)
                ->pluck('branch_id')
                ->unique()
                ->toArray();

            // Fetch departments and branches only if they match exactly
            $allDepartments = Department::whereIn('id', $departmentIds)->get();
            $allBranches = Branch::whereIn('id', $branchIds)->get();
        }

        return [
            Filter::inputText('employee_id')->operators(['contains']),
            Filter::inputText('first_name')->operators(['contains']),
            Filter::inputText('last_name')->operators(['contains']),
            Filter::inputText('date_hired')->operators(['contains']),
            Filter::inputText('position')->operators(['contains']),
            Filter::inputText('employment_status')->operators(['contains']),
            // Filter::inputText('department_name')->operators(['contains']),
            // Filter::inputText('branch_name')->operators(['contains']),
            // Filter::inputText('employment_status')->operators(['contains']),
            (auth()->user()->role_id === 1 || auth()->user()->role_id === 5)
                ? Filter::select('department_name', 'department_id')
                ->dataSource($allDepartments)
                ->optionValue('id')
                ->optionLabel('name')
                : null,
            (auth()->user()->role_id === 1 || auth()->user()->role_id === 5)
                ? Filter::select('branch_name', 'branch_id')
                ->dataSource($allBranches)
                ->optionValue('id')
                ->optionLabel('name')
                : null,
        ];
    }



    #[\Livewire\Attributes\On('edit')]
    public function edit($employeeId)
    {
        return redirect()->route('evaluations.select', ['employeeId' => $employeeId]);
    }

    #[\Livewire\Attributes\On('show')]
    public function show($employee_id)
    {
        return redirect()->route('employees.show', ['employee_id' => $employee_id]);
    }

    #[\Livewire\Attributes\On('showEmployee')]
    public function showEmployee($employee_id)
    {
        return redirect()->route('employees.evaluations-view', ['employee_id' => $employee_id]);
    }


    public function actions(Employee $employeeId): array
    {
        if (Auth::user()->role_id != 5) {
            $actions[] = Button::add('edit')
                ->slot('Evaluate')
                ->id()
                ->class('btn btn-block btn-outline-success')
                ->dispatch('edit', ['employeeId' => $employeeId->id]);
        }

        if (Auth::user()->role_id == 1) {
            $actions[] = Button::add('show')
                ->slot('Show')
                ->id()
                ->class('btn btn-block btn-outline-secondary')
                ->dispatch('show', ['employee_id' => $employeeId->employee_id]);
        }

        if (Auth::user()->role_id == 5) {
            $actions[] = Button::add('showEmployee')
                ->slot('Show')
                ->id()
                ->class('btn btn-block btn-outline-secondary')
                ->dispatch('showEmployee', ['employee_id' => $employeeId->id]);
        }

        return $actions;
    }
}
