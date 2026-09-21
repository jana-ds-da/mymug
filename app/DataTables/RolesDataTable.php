<?php

namespace App\DataTables;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RolesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
         

            ->addColumn('actions', function ($role) {

                $editUrl = route('roles.edit', ['role' => $role->id]);
                $deleteUrl = route('roles.destroy', ['role' => $role->id]);

                return '
                   <div class="d-flex justify-content-center align-items-center gap-3"
                         style="white-space: nowrap;">

                         <a href="' . $editUrl . '"
                           class="btn p-0 border-0 bg-transparent"
                           style="color: #B85C2F;"
                           title="Edit Role">
                             <i class="fas fa-pen"></i>
                         </a>

                         <button type="button"
                                class="btn p-0 border-0 bg-transparent delete-this-role"
                                style="color: #B85C2F;"
                                data-id="' . $role->id . '"
                                data-url="' . $deleteUrl . '"
                                title="Delete Role">
                                <i class="fas fa-trash"></i>
                            </button>

                      </div>
                      ';
                   })

            ->rawColumns(['actions'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Role $model): QueryBuilder
    {
        return $model->newQuery()
            ->with('permissions')
            ->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use the HTML builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('rolesTable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('<B><"d-flex w-100 py-2 align-items-center justify-content-end"f>rtip')
            ->orderBy(0)
            ->buttons([
                Button::make('excel')
                    ->text('<i class="fas fa-file-excel"></i> Excel')
                    ->exportOptions(['columns' => ':not(:last-child)'])
                    ->addClass('btn-sm'),

                Button::make('csv')
                    ->text('<i class="fas fa-file-csv"></i> CSV')
                    ->exportOptions(['columns' => ':not(:last-child)'])
                    ->addClass('btn-sm'),

                Button::make('print')
                    ->text('<i class="fas fa-print"></i> Print')
                    ->addClass('btn-sm'),

                Button::raw([
                    'text' => '<i class="fas fa-sync-alt"></i> Reload',
                    'action' => 'function(e, dt, node, config) {
                        dt.ajax.reload();
                    }',
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
                ->title('Id')
                ->addClass('text-center'),

            Column::make('name')
                ->title('Role')
                ->addClass('text-center'),

            Column::computed('actions')
                ->title('Actions')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Roles_' . date('YmdHis');
    }
}