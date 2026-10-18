@extends('layouts.app')

@section('title','checkout')

@section('css')
   <link rel='stylesheet' href='{{ asset('css/checkout.css') }}'>
@endsection   

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ __('messages.checkout_payment') }} | My Mug</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    
</head>

    <div class="page-bg"></div>

    <div class="checkout-card" id="checkout-form-section">

       

        <h1 class="checkout-title">{{ __('messages.checkout_payment') }} </h1>

        <div class="checkout-content">

            <div class="checkout-left">

                <div class="section-heading">
                    <div class="section-heading" style="margin-top: 30px;">
                               {{ __('messages.shipping_address') }}
                    </div>
                </div>
                <form id="checkout-form" method='POST' action='{{ route('checkout.store') }}'>
                    @csrf


                    <input type="text" id="full-name" name='full_name' placeholder="{{ __('messages.full_name') }}"  required >

                   <input type="email" id="email" name='email' placeholder="{{ __('messages.email_address') }}"   >

                  <input type="tel" id="phone"  name='phone' placeholder="{{ __('messages.phone') }}" required >

                 <input type="text" id="address"  name='address' placeholder="{{ __('messages.street_address') }}"  required >

                 <div class="row-2">

                    <input type="text" id="city" name='city' placeholder="{{ __('messages.city') }}" required >

                      <input type="text" id="state" name='state' placeholder="{{ __('messages.state_governorate') }}" required>

                 </div>

                 <div class="row-2">

                    <input type="text" id="zip" name='zip'  placeholder="{{ __('messages.zip') }}">

                    <input type="text" id="country" name='country' placeholder="{{ __('messages.country') }}" value="{{ app()->getLocale() === 'ar' ? 'مصر' : 'Egypt' }}"  required>

                 </div>

                   
               
                <div class="section-heading" style="margin-top:30px;">
                    {{ __('messages.payment_method') }}
               </div>

               <div class="payment-options">
                <label>
                   <input type="radio" name="payment" value="Credit Card" checked>
                      {{ __('messages.credit_card') }}
               </label>

               <label>
                   <input type="radio" name="payment" value="Cash on Delivery">
                       {{ __('messages.cash_on_delivery') }}
                </label>
            </div>

           <div id="card-payment-fields">
               <input
                  type="text"
                  id="card-number"
                  name="card_number"
                  placeholder="{{ __('messages.card_number') }}"
                  inputmode="numeric"
                  autocomplete="cc-number"
               >

           <div class="row-2">
               <input
                   type="text"
                   id="expiry"
                   name="expiry"
                   placeholder="{{ __('messages.expiry') }}"
                   autocomplete="cc-exp"
                >

               <input
                  type="password"
                  id="cvv"
                  name="cvv"
                  placeholder="{{ __('messages.cvv') }}"
                  inputmode="numeric"
                  autocomplete="cc-csc"
               >
             </div>
          </div>



                    <button type="submit" class="place-order-btn">{{ __('messages.place_order') }}</button>
                </form>
            </div>

            <div class="checkout-right">

                <div class="summary-line">
                    <span>{{ __('messages.subtotal') }}</span>
                    <span id="checkout-subtotal-val">EGP0.00</span>
                </div>

                <div class="summary-box">
                    <h2>{{ __('messages.order_summary') }}</h2>
                    <div id="checkout-items"></div>


                    <div class="summary-line">
                        <span>{{ __('messages.shipping') }}</span>
                        <span id="shipping-val">EGP200</span>
                    </div>
                    
                    <div class="summary-total">
                        <span>{{ __('messages.order_total') }}:</span>
                        <span id="checkout-total-val">EGP0</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="checkout-footer">
            <a href="{{ route('cart') }}">{{ __('messages.return_to_cart') }}</a>
            <span>{{ __('messages.secure_private') }}</span>
        </div>

    </div>

    <script>
        const cart = @json($cartItems);
    </script>
    
    <script src="js/bootstrap.bundle.min.js"></script>
    @vite('resources/js/checkout.js')

@endsection