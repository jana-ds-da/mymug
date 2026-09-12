<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductRequest;

use App\Models\Category;



class ProductController extends Controller
{
    public function store(ProductRequest $request)
    {
        $validated = $request->validated();
          

        
        $imagePath = $request->file('image')->store('products', 'public');

        
        Product::create([
            'mug_name' => $validated['mug_name'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
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
        $categories = Category::all();
        return view('product', compact('product', 'categories'));
    }




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







   public function update(ProductRequest $request, Product $product)
   {  
     
    $validated = $request->validated();


     $product->mug_name = $validated['mug_name'];
     $product->price = $validated['price'];
     $product->category_id = $validated['category_id'];
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






}