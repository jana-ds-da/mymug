<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\DataTables;

class ProductsDataTable
{
    public function getData()
    {
        $products = Product::with('category')
            ->select('products.*');

        return DataTables::of($products)
            ->addIndexColumn()

            ->addColumn('category', function ($product) {
                return $product->category->name ?? '-';
            })

            ->filterColumn('category', function ($query, $keyword) {
                $query->whereHas('category', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })

            ->addColumn('image', function ($product) {
                return '<img src="' . $product->image_url . '" width="70">';
            })

            ->rawColumns(['image'])

            ->make(true);
    }
}

