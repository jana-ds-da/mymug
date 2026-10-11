<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

use App\Models\Category;

class CollectionController extends Controller
{
    public function index(Request $request)
{
   $categories = Category::all();

    $products = Product::when(
            $request->category,
            function ($query) use ($request) {

                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('slug', $request->category);
                });

            }
        )->latest()->get();

   return view('collection', compact('products', 'categories'));
  
}
    
}
