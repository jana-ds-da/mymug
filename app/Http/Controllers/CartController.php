<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())
            ->with('product')
            ->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('cart', compact('cartItems', 'subtotal'));
    }
      // add function

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'buy_now' => 'sometimes|boolean',
        ]);

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($request->boolean('buy_now')) {

            $quantity = (int) $request->input('quantity', 1);

            if ($cartItem) {
                $cartItem->quantity = $quantity;
                $cartItem->save();
            } else {
                $cartItem = new CartItem();
                $cartItem->user_id = Auth::id();
                $cartItem->product_id = $request->product_id;
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }

            $cartCount = CartItem::where('user_id', Auth::id())
                ->sum('quantity');

            return response()->json([
                'success' => true,
                'redirect' => route('cart'),
                'cart_count' => $cartCount,
            ]);
        }

        if ($cartItem) {
            $cartItem->increment('quantity', $request->quantity);
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        $cartCount = CartItem::where('user_id', Auth::id())
            ->sum('quantity');

        return response()->json([
            'success' => true,
            'message' => __('messages.product_added_to_cart'),
            'cart_count' => $cartCount,
        ]);
    }

      // increase function
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

     // decrease function
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

      // remove function
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
   
       // emptycart function
    public function emptyCart()
    {
        CartItem::where('user_id', Auth::id())->delete();

        return redirect()->route('cart')
            ->with('success', 'Your cart has been emptied.');
    }
}
