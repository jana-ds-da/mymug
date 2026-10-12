<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     */
   
      
       public function dataTable(QueryBuilder $query): EloquentDataTable
        {
            return (new EloquentDataTable($query))

                ->addColumn('name', function ($model) {
                    return e($model->translate('en')?->name ?? '-');
               })

               ->addColumn('actions', function ($model) {

                   $editUrl = route('category.edit', $model->id);
                   $deleteUrl = route('category.destroy', $model->id);

                    return '
                       <div class="d-flex justify-content-center align-items-center gap-3">

                         <a href="' . $editUrl . '"
                           class="btn p-0 border-0 bg-transparent"
                           style="color: #B85C2F;"
                           title="Edit Category">
                           <i class="fas fa-pen"></i>
                         </a>

                         <form action="' . $deleteUrl . '"
                             method="POST"
                             style="display:inline-block"
                             onsubmit="return confirm(\'Are you sure you want to delete this category?\')">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '

                        <button type="submit"
                                class="btn p-0 border-0 bg-transparent"
                                style="color: #B85C2F;"
                                title="Delete Category">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>

                </div>
            ';
        })

        ->filterColumn('name', function ($query, $keyword) {
           $query->whereHas('translations', function ($q) use ($keyword) {
             $q->where('locale', 'en')
               ->where('name', 'like', '%' . $keyword . '%');
           });
       })

        ->rawColumns(['actions'])
        ->setRowId('id');
}


    /**
     * Get the query source of dataTable.
     */
    public function query(Category $model, Request $request): QueryBuilder
    {
        return $model->newQuery()
            ->with('translations')
            ->withCount('products')
            ->orderByDesc('id');
    }

    /**
     * Configure the HTML builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('categoriesTable')
            ->columns($this->getColumns())
            ->ajax(route('category.index'))
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
                    ->exportOptions(['columns' => ':not(:last-child)'])
                    ->addClass('btn-sm'),

                Button::raw([
                    'text' => '<i class="fas fa-sync-alt"></i> Reload',
                    'action' => 'function(e, dt, node, config) {
                        dt.ajax.reload();
                    }',
                    'className' => 'btn-sm',
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
     * Get the DataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')
                ->title('ID')
                ->addClass('text-center'),

            Column::make('name')
                ->title(__('messages.category_name_en'))
                ->addClass('text-center'),

           Column::make('products_count')
               ->title(__('messages.category_products'))
               ->addClass('text-center')
               ->searchable(false)
               ->orderable(false),

            Column::computed('actions')
                ->title(__('messages.actions'))
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false)
                ->width(80)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the export filename.
     */
    protected function filename(): string
    {
        return 'Categories_' . date('YmdHis');
    }
}
