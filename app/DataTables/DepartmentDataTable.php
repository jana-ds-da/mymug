<?php

namespace App\DataTables;

use App\Models\Department;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DepartmentDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->addColumn('actions', function ($model) {

                $editUrl = route('departments.edit', [
                    'department' => $model->id
                ]);

                $deleteUrl = route('departments.destroy', [
                    'department' => $model->id
                ]);

                return '
                    <div class="d-flex justify-content-center align-items-center gap-3">

                        <a href="' . $editUrl . '"
                           class="btn p-0 border-0 bg-transparent"
                           style="color: #B85C2F;"
                           title="Edit Department">
                            <i class="fas fa-pen"></i>
                        </a>

                        <button type="button"
                                class="btn p-0 border-0 bg-transparent delete-this-department"
                                style="color: #B85C2F;"
                                data-id="' . $model->id . '"
                                data-url="' . $deleteUrl . '"
                                title="Delete Department">
                            <i class="fas fa-trash"></i>
                        </button>

                    </div>
                ';
            })

            ->editColumn('name', function ($model) {
                return ucfirst($model->name);
            })

            ->addColumn('users_count', function ($model) {
                return $model->users_count;
            })

           ->editColumn('status', function ($model) {
                 if ($model->status) {
                     return '<span class="badge bg-success">'
                       . e(__('messages.active'))
                       . '</span>';
                 }

                  return '<span class="badge bg-secondary">'
                      . e(__('messages.inactive'))
                      . '</span>';
              })

            ->editColumn('created_at', function ($model) {
                return $model->created_at
                    ? $model->created_at->format('d/m/Y')
                    : '-';
            })

            ->editColumn('updated_at', function ($model) {
                return $model->updated_at
                    ? $model->updated_at->format('d/m/Y')
                    : '-';
            })

            ->rawColumns([
                'actions',
                'status',
            ])

            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(
        Department $model,
        Request $request
    ): QueryBuilder {
        return $model
            ->newQuery()
            ->withCount('users')
            ->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('departmentsTable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('<B><"d-flex w-100 py-2 align-items-center justify-content-end"f>rtip')
            ->orderBy(0)
            ->buttons([

                Button::make('excel')
                    ->text('<i class="fas fa-file-excel"></i> Excel')
                    ->exportOptions([
                        'columns' => ':not(:last-child)'
                    ])
                    ->addClass('btn-sm'),

                Button::make('csv')
                    ->text('<i class="fas fa-file-csv"></i> CSV')
                    ->exportOptions([
                        'columns' => ':not(:last-child)'
                    ])
                    ->addClass('btn-sm'),

                Button::make('print')
                    ->text('<i class="fas fa-print"></i> Print')
                    ->addClass('btn-sm'),

                Button::raw([
                    'text' => '<i class="fas fa-sync-alt"></i> Reload',
                    'action' => 'function(e, dt, node, config) { dt.ajax.reload(); }',
                    'className' => 'btn-sm'
                ]),
            ])

            ->addTableClass('table table-hover align-middle')

            ->parameters([
                'initComplete' => 'function() {
                    this.api().columns().header().to$().each(function() {
                        $(this).attr("title", $(this).text());
                    });
                }',
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    
public function getColumns(): array
{
    return [
        Column::make('id')
            ->title(__('messages.id'))
            ->addClass('text-center'),

        Column::make('name')
            ->title(__('messages.department_name'))
            ->addClass('text-center'),

        Column::computed('users_count')
            ->title(__('messages.users_count'))
            ->addClass('text-center')
            ->orderable(false)
            ->searchable(false),

        Column::make('status')
            ->title(__('messages.status'))
            ->addClass('text-center'),

        Column::make('created_at')
            ->title(__('messages.created_at'))
            ->addClass('text-center'),

        Column::make('updated_at')
            ->title(__('messages.updated_at'))
            ->addClass('text-center'),

        Column::computed('actions')
            ->title(__('messages.actions'))
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
    ];
}


    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Departments_' . date('YmdHis');
    }
}