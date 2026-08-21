@extends('layouts.app')

@section('title','checkout')

@section('css')
   <link rel='stylesheet' href='{{ asset('css/checkout.css') }}'>
@endsection   

@section('content')




<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Checkout | My Mug</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    
</head>





    
   

    <div class="page-bg"></div>

    <div class="checkout-card" id="checkout-form-section">

       

        <h1 class="checkout-title">Checkout &amp; Payment</h1>

        <div class="checkout-content">

            <div class="checkout-left">

                <div class="section-heading">
                    <div class="section-heading" style="margin-top: 30px;">
                               Shipping Address
                    </div>
                </div>
                <form id="checkout-form" method='POST' action='{{ route('checkout.store') }}'>
                    @csrf


                    <input type="text" id="full-name" name='full_name' placeholder="Full Name" >

                   <input type="email" id="email" name='email' placeholder="Email Address" >

                  <input type="tel" id="phone"  name='phone' placeholder="phone(01XXXXXXXXX)" >

                 <input type="text" id="address"  name='address' placeholder="Street Address" >

                 <div class="row-2">

                    <input type="text" id="city" name='city' placeholder="City" >

                      <input type="text" id="state" name='state' placeholder="State / Governorate">

                 </div>

                 <div class="row-2">

                    <input type="text" id="zip" name='zip'  placeholder="zip(12345)">

                    <input type="text" id="country" name='country' placeholder="Country" value="Egypt">

                 </div>

                    
                    <div class="section-heading" style="margin-top:30px;">
                         Payment Method
                    </div>
                    
                    <div class="payment-options">
                        <label><input type="radio" name="payment" value="Credit Card" checked> Credit Card</label>
                        <label><input type="radio" name="payment" value="PayPal"> PayPal</label>
                        <label><input type="radio" name="payment" value="Apple Pay"> Apple Pay</label>
                    </div>

                    <input type="text" id="card-number" name='card_number' placeholder="card_number(1234 5678 9012 3456)">
                    <div class="row-2">
                        <input type="text" id="expiry" name='expiry' placeholder=" Expiry(MM/YY)">
                        <input type="text" id="cvv" name='cvv' placeholder="cvv(123)">
                    </div>

                    <button type="submit" class="place-order-btn">Place Order</button>
                </form>
            </div>

            <div class="checkout-right">

                <div class="summary-line">
                    <span>Subtotal</span>
                    <span id="checkout-subtotal-val">EGP0.00</span>
                </div>

                <div class="summary-box">
                    <h2>Order Summary</h2>
                    <div id="checkout-items"></div>


                    <div class="summary-line">
                        <span>Shipping</span>
                        <span id="shipping-val">EGP200</span>
                    </div>
                    
                    <div class="summary-total">
                        <span>Order Total:</span>
                        <span id="checkout-total-val">EGP0</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="checkout-footer">
            <a href="{{ route('cart') }}">Return to Cart</a>
            <span>Secure &amp; Private</span>
        </div>

    </div>


  


    <script>
        const cart = @json($cartItems);
    </script>
    
    
    <script src="js/bootstrap.bundle.min.js"></script>
    @vite('resources/js/checkout.js')


@endsection