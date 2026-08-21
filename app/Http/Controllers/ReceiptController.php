<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class ReceiptController extends Controller
{
    public function show(Order $order)
    {
      $order->load('items.product');
      return view('receipt', compact('order'));
    }
}
