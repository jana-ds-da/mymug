<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CollectionController extends Controller
{
    public function index()
{
   $products = Product::all();

   return view('collection', compact('products'));
  
}

   public function filter(Request $request)
   {

        $products = Product::when($request->category && $request->category !== 'all', function ($query) use ($request) {
           $query->where('category', $request->category);
        })->latest()->get();

         $categories = Product::select('category')->distinct()->pluck('category');

        return view('collection', compact('products', 'categories'));
   }
}
