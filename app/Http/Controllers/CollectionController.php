<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

use App\Models\Category;

class CollectionController extends Controller
{
    public function index()
{
   $products = Product::all();

   return view('collection', compact('products'));
  
}
        // filter function
   public function filter(Request $request)
   {

       $products = Product::when($request->category && $request->category !== 'all', function ($query) use ($request) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', request('category'));
            });
        })->latest()->get();

        $categories = Category::all();

        return view('collection', compact('products', 'categories'));
    }
}
