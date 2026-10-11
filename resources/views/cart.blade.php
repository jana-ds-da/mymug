@extends('layouts.app')

@section('title','cart')

@section('css')
    <link rel='stylesheet' href='{{ asset('css/cart.css') }}'>
@endsection    

@section('content')


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - my mug</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght=0,400..700;1,400..700&family=Plus+Jakarta+Sans:wght=300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    
</head>

    
    <div class="cart-page">

    <div class="cart-box">
        <div class="cart-items" id="cart-items-container">
            @forelse($cartItems as $item)
                <div class="cart-item" data-item-id="{{ $item->id }}">
                    <div class="item-image-wrapper">
                        <img src="{{ $item->product->image_url }}"
                             alt="{{ $item->product->mug_name }}"
                             class="item-image">
                    </div>

                    <div class="item-info">
                        <div class="item-top">
                            <div>
                                <span class="item-tag">{{ __('messages.small_batch') }}</span>
                                <h2 class="item-name">{{ $item->product->mug_name }}</h2>
                            </div>
                            <button type="button" class="delete-btn" data-id="{{ $item->id }}" title="{{ __('messages.remove_product') }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>

                        <p class="qty-label">{{ __('messages.quantity') }}:</p>

                        <div class="qty-selector" data-id="{{ $item->id }}">
                            <button type="button" class="qty-btn qty-decrease">−</button>
                            <span class="qty-value">{{ $item->quantity }}</span>
                            <button type="button" class="qty-btn qty-increase">+</button>
                        </div>

                        <p class="item-price" data-price="{{ $item->product->price }}">
                            {{ number_format($item->product->price * $item->quantity, 2) }} EGP
                        </p>
                    </div>
                </div>
            @empty
                <p style="padding: 20px;">{{ __('messages.empty_cart') }}</p>
            @endforelse
        </div>
    </div>

    <div class="order-summary">
        <h3> {{ __('messages.order_summary') }}</h3>
        <p><strong>{{ __('messages.cart_total') }}</strong></p>
        <p>{{ __('messages.subtotal') }}: <span id="subtotal-val">{{ number_format($subtotal, 2) }} EGP</span></p>
        <p>{{ __('messages.shipping') }}: <span>{{ __('messages.calculated_at_checkout') }}</span></p>
        <hr>
        <p><strong>{{ __('messages.total') }}:</strong> <span id="total-val">{{ number_format($subtotal, 2) }} EGP</span></p>
        <a href='{{ asset('checkout') }}' class='checkout-btn'>{{ __('messages.checkout_now') }}</a>
        <a href="{{ asset('collection') }}" class="continue-link">{{ __('messages.continue_shopping') }}
</a>
    </div>

</div>

   <script>
      const translations = {
        cartError: @json(__('messages.cart_error')),
        removeProductConfirm: @json(__('messages.remove_product_confirm')),
      };
  </script>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @vite('resources/js/cart.js') 

@endsection