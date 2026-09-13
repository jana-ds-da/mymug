<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductRequest;

use App\Models\Category;



class ProductController extends Controller
{
    public function index(Request $request)
{
    $categories = Category::all();

    $products = Product::when($request->category && $request->category !== 'all', function ($query) use ($request) {
        $query->whereHas('category', function ($q) use ($request) {
            $q->where('slug', request('category'));
        });
    })->latest()->get();

    return view('collection', compact('products', 'categories'));
}    

          // show function

     public function show(Product $product)
    {   
        $categories = Category::all();
        return view('product', compact('product', 'categories'));
    }

        // store function
     public function store(ProductRequest $request)
    {
        
        $imagePath = $request->file('image')->store('products', 'public');

        
        Product::create([
           'mug_name' => $request->mug_name,
           'price' => $request->price,
           'category_id' => $request->category_id,
           'description' => $request->description,
           'capacity' => $request->capacity,
           'how_its_made' => $request->how_its_made,
           'microwave' => $request->microwave,
          ]);

        return redirect()
            ->back()
            ->with('success', 'Product added successfully.');
    }

        // update function
    public function update(ProductRequest $request, Product $product)
   {  
     
        $product->mug_name = $request->mug_name;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->capacity = $request->capacity;
        $product->how_its_made = $request->how_its_made;
        $product->microwave = $request->microwave;
      

      if ($request->hasFile('image')) {

        
        if ($product->image_path && Storage::disk('public')->exists($product->image_path)){
        
            Storage::disk('public')->delete($product->image_path);
        }

        
        $product->image_path = $request->file('image')
            ->store('products', 'public');
    }

    $product->save();

    return redirect()
        ->route('dashboard')
        ->with('success', 'Product updated successfully.');
}

       // destroy function
   public function destroy(Product $product)
{

    if($product->image_path && Storage::disk('public')->exists($product->image_path)){
        Storage::disk('public')->delete($product->image_path);
    }


    $product->delete();

    return response()->json([
        'message' => 'Product deleted successfully.'
    ]);
}


}