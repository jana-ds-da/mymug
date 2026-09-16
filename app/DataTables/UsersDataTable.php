<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->addColumn('actions', function ($model) {

                $editUrl = route('users.edit', ['user' => $model->id]);
                $deleteUrl = route('users.destroy', ['user' => $model->id]);

                return '
              <div class="d-flex justify-content-center gap-2">

            <a href="' . $editUrl . '"
               class="btn btn-sm btn-outline-warning"
               title="Edit Product">
                <i class="fa-solid fa-pen"></i>
            </a>

            <button type="button"
                    class="btn btn-sm btn-outline-danger delete-this-product"
                    data-id="' . $model->id . '"
                    data-url="' . $deleteUrl . '"
                    title="Delete Product">
                <i class="fa-solid fa-trash"></i>
            </button>

        </div>
    ';
})

            ->addColumn('role', function ($user) {
                return $user->getRoleNames()->first() ?? '-';
            })

            ->filterColumn('role', function ($query, $keyword) {
                $query->whereHas('roles', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })

            ->rawColumns(['actions'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model, Request $request): QueryBuilder
    {
        return $model->newQuery()
            ->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('usersTable')
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
                ->title('Id')
                ->addClass('text-center'),

            Column::make('name')
                ->title('Name')
                ->addClass('text-center'),

            Column::make('email')
                ->title('Email')
                ->addClass('text-center'),

            Column::computed('role')
                ->title('Role')
                ->addClass('text-center')
                ->orderable(false)
                ->searchable(true),

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
        return 'Users_' . date('YmdHis');
    }
}