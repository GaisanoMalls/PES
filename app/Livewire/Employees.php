<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Employee;
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
        return Employee::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('employee_id')

            ->addColumn('department_id')

            ->addColumn('department_name', fn (Employee $model) => $model->department->name)


            ->addColumn('first_name')
            ->addColumn('last_name')
            ->addColumn('date_hired')
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

            Column::make('Department Name', 'department_name')
                ->searchable(),

            Column::make('First name', 'first_name')
                ->sortable()
                ->searchable(),

            Column::make('Last name', 'last_name')
                ->sortable()
                ->searchable(),



            Column::make('Position', 'position')
                ->sortable()
                ->searchable(),

            // Column::make('Employment status', 'employment_status')
            //     ->sortable()
            //     ->searchable(),

            // Column::make('Is active', 'is_active')
            //     ->toggleable(),


            // Column::make('Created at', 'created_at_formatted', 'created_at')
            //     ->sortable(),

            Column::make('Date hired', 'date_hired')
                ->sortable()
                ->searchable(),

            Column::action('Action'),

        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('employee_id')->operators(['contains']),
            Filter::inputText('first_name')->operators(['contains']),
            Filter::inputText('last_name')->operators(['contains']),
            Filter::inputText('date_hired')->operators(['contains']),
            Filter::inputText('position')->operators(['contains']),
            // Filter::inputText('employment_status')->operators(['contains']),
            Filter::select('department_name', 'department_id')
                ->dataSource(Department::all())
                ->optionValue('id')
                ->optionLabel('name'),
            // Filter::datetimepicker('created_at'),
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

    public function actions(Employee $employeeId): array
    {
        $actions = [
            Button::add('edit')
                ->slot('Evaluate')
                ->id()
                ->class('btn btn-block btn-outline-success')
                ->dispatch('edit', ['employeeId' => $employeeId->id]),
        ];

        if (Auth::user()->role_id == 1) {
            $actions[] = Button::add('show')
                ->slot('Show')
                ->id()
                ->class('btn btn-block btn-outline-secondary')
                ->dispatch('show', ['employee_id' => $employeeId->employee_id]);
        }

        return $actions;
    }





    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
