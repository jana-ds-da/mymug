<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {

       $request->validate([
           'product_id' => 'required|exists:products,id',
           'quantity' => 'required|integer|min:1',
       ]);

        $cartItem = CartItem::where('user_id', Auth::id())
               ->where('product_id', $request->product_id)
               ->first();

        if ($cartItem)
          { $cartItem->increment('quantity', $request->quantity);


          }   else {
            $cartItem = CartItem::create([
                'user_id' =>  Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
          }  
          
        if ($request->buy_now) {
            return redirect()->route('cart');
        }  

        return response()->json([

           'success' => true,
           'message' => __('messages.product_added_to_cart'),
        ]); 

    }  





    
    
    public function index() {

      $cartItems = CartItem::where('user_id', Auth::id())
            ->with('product')
            ->get();
      $subtotal = $cartItems->sum(function ($item) {

         return $item->quantity * $item->product->price;
      });  

        return view('cart', compact('cartItems' , 'subtotal'));  
    }










  public function increase(CartItem $cartItem) 
  {

     if ($cartItem->user_id !== Auth::id()) {
       abort(403);
     }

     $cartItem->increment('quantity');

     $cartItem->load('product');

     $subtotal = CartItem::where('user_id', Auth::id())
        ->with('product')
        ->get()
        ->sum(function ($item) {
          return $item->quantity * $item->product->price;
        });

      
      return response()->json([

            'quantity' => $cartItem->quantity,
            'item_total' => $cartItem->quantity * $cartItem->product->price,
            'subtotal' => $subtotal,
            'total' => $subtotal,
      ]);  
  } 
  

  public function decrease(CartItem $cartItem)
    {
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        
        if ($cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
        }

        $cartItem->load('product');

        $subtotal = CartItem::where('user_id', Auth::id())
            ->with('product')
            ->get()
            ->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });

        return response()->json([
            'quantity' => $cartItem->quantity,
            'item_total' => $cartItem->quantity * $cartItem->product->price,
            'subtotal' => $subtotal,
            'total' => $subtotal,
        ]);
     
  } 
  

   public function remove(CartItem $cartItem)
    {
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $cartItem->delete();

        $subtotal = CartItem::where('user_id', Auth::id())
            ->with('product')
            ->get()
            ->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });

        return response()->json([
            'subtotal' => $subtotal,
            'total' => $subtotal,
        ]);
    }






}







