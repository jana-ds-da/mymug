<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.product'])
             ->latest()
             ->get();

        return view('orders.all-orders', compact('orders'));     
    }

    public function myorders()
    {
        $orders = Order::with(['items.product'])
           ->where('user_id', Auth::id())
           ->latest()
           ->get();

        return view('orders.my-orders', compact('orders'));

    }

       // update
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' =>[
                'required',
                'in:pending,preparing,delivered',

            ],

        ]);

        $order->update([
            'status' => $validated['status'],
        ]);

        return response()->json([
            'success' => true,
            'message' =>__('message.order_status_updated'),
            'status' => $order->status,
        ]);
    }
 
       // destroy
    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json([
            'success' => true,
            'message' => __('message.order_deleted_successfully'),
        ]);
    }

       // show
    public function show(\App\Models\Order $order)
{
    $order->load('items.product');

    return view('orders.show', compact('order'));
}
}
