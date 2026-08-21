<?php

namespace App\Http\Controllers;


use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\NewOrderMail;
use Illuminate\Support\Facades\Mail;




class CheckoutController extends Controller
{

   public function index()
   {

     $cartItems = CartItem::with('product')
         ->where('user_id', Auth::id())
         ->get();


      if($cartItems->isEmpty()) {

         return redirect()->route('cart')
             ->with('error', 'your cart is empty.');
         
      } 
      
        return view('checkout', compact('cartItems'));
   }


    public function store(CheckoutRequest $request) 
    {

      $data = $request->validated();

      $cartItems = CartItem::with('product')
           ->where('user_id', Auth::id())
           ->get();

       if ($cartItems->isEmpty()) {

            return back()->with('error', 'Your cart is empty.');

        }  


         $order = DB::transaction(function () use ($data, $cartItems) {

             $order = Order::create([
                'user_id' => Auth::id(),
                'full_name' => $data['full_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'city' => $data['city'],
                'state' => $data['state'] ?? null,
                'zip' => $data['zip'] ?? null,
                'country' => $data['country'],
                'payment' => $data['payment'],
                 'total' => 0,
             ]);

    $total = 0;

    foreach ($cartItems as $cartItem) {

        $price = $cartItem->product->price;

        $totalPrice = $price * $cartItem->quantity;

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $cartItem->product_id,
            'quantity' => $cartItem->quantity,
            'price' => $price,
            'total_price' => $totalPrice,
        ]);

        $total += $totalPrice;
    }

    $shipping = 200;

    $order->update([
        'total' => $total + $shipping,
    ]);



  
          

    CartItem::where('user_id', Auth::id())->delete();

    return $order;
  });

  


  Mail::to('janamuhammad.ai@gmail.com')
        ->send(new NewOrderMail($order));

  

  return redirect()->route('receipt', ['order' => $order->id]);      

  

} 





}