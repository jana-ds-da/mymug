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
                        <img src="{{ asset('storage/' . $item->product->image_path) }}"
                             alt="{{ $item->product->mug_name }}"
                             class="item-image">
                    </div>

                    <div class="item-info">
                        <div class="item-top">
                            <div>
                                <span class="item-tag">SMALL-BATCH</span>
                                <h2 class="item-name">{{ $item->product->mug_name }}</h2>
                            </div>
                            <button type="button" class="delete-btn" data-id="{{ $item->id }}" title="Remove product">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>

                        <p class="qty-label">Quantity:</p>

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
                <p style="padding: 20px;">EMPTY CART</p>
            @endforelse
        </div>
    </div>

    <div class="order-summary">
        <h3>Order Summary</h3>
        <p><strong>Cart Total</strong></p>
        <p>Subtotal: <span id="subtotal-val">{{ number_format($subtotal, 2) }} EGP</span></p>
        <p>Shipping: <span>Calculated at checkout</span></p>
        <hr>
        <p><strong>Total:</strong> <span id="total-val">{{ number_format($subtotal, 2) }} EGP</span></p>
        <a href='{{ asset('checkout') }}' class='checkout-btn'>CHECKOUT NOW </a>
        <a href="{{ asset('collection') }}" class="continue-link">Continue Shopping</a>
    </div>

</div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @vite('resources/js/cart.js') 

@endsection