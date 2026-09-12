<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
               

               $editUrl = route('dashboard', ['edit' => $model->id]);
    $deleteUrl = route('products.destroy', ['product' => $model->id]);

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
           ->editColumn('image_path', function ($model) {
               return $model->image_path
                  ? '<img src="' . asset('storage/' . $model->image_path) . '"
                       alt="' . e($model->mug_name) . '"
                       style="width:50px;height:50px;border-radius:8px;object-fit:cover;">'
                  : '<span class="text-muted">No Image</span>';
            })
            ->editColumn('mug_name', function ($model) {
                return ucfirst($model->mug_name);
            })
            ->editColumn('price', function ($model) {
                return number_format($model->price, 2) . ' EGP';
            })
            ->addColumn('category', function ($model) {
                 return $model->category->name ?? '-';
            })

            ->filterColumn('category', function ($query, $keyword) {
                $query->whereHas('category', function ($q) use ($keyword) {
                   $q->where('name', 'like', "%{$keyword}%");
                });
            })

            ->rawColumns(['actions', 'image_path'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model, Request $request): QueryBuilder
    {
        return $model->newQuery()->with('category')->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('productsTable')
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
            Column::make('id') ->title('Id') ->addClass('text-center'),
            Column::make('image_path')->title('Image')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('mug_name')->title('Name')->addClass('text-center'),
            Column::make('price')->title('Price')->addClass('text-center'),
           Column::computed('category')->title('Category')->addClass('text-center')->orderable(false)->searchable(true),
            Column::computed('actions')->title('Actions')
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
        return 'Products_' . date('YmdHis');
    }
}