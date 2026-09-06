<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductRequest;
use Yajra\DataTables\Facades\DataTables;




class ProductController extends Controller
{
    public function store(ProductRequest $request)
    {
        $validated = $request->validated();
          

        
        $imagePath = $request->file('image')->store('products', 'public');

        
        Product::create([
            'mug_name' => $validated['mug_name'],
            'price' => $validated['price'],
            'category' => $validated['category'],
            'image_path' => $imagePath,
            'description' => $validated['description'],
            'capacity' => $validated['capacity'],
            'how_its_made' => $validated['how_its_made'],
            'microwave' => $validated['microwave'],
        ]);

        return redirect()
            ->back()
            ->with('success', 'Product added successfully.');
    }

    public function show(Product $product)
    {
        return view('product', compact('product'));
    }




   public function destroy(Product $product)
   {

    if($product->image_path && storage::disk('public')->exists($product->image_path)){
        storage::disk('public')->delete($product->image_path);
    }

       
    $product->delete();

    return redirect()
        ->route('dashboard')
        ->with('success', 'Product delete successfully.');
   }







   public function update(ProductRequest $request, Product $product)
   {  
     
    $validated = $request->validated();


     $product->mug_name = $validated['mug_name'];
     $product->price = $validated['price'];
     $product->category = $validated['category'];
     $product->description = $validated['description'];
     $product->capacity = $validated['capacity'];
     $product->how_its_made = $validated['how_its_made'];
     $product->microwave = $validated['microwave'];
      

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




public function data()
{
    $products = Product::query();

    return DataTables::of($products)
      ->addIndexColumn()
      ->make(true);
}

}