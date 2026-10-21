@extends('layouts.app')

@section('title','product')

@section('css')
   <link rel='stylesheet' href='{{ asset('css/product.css') }}'>
@endsection   

@section('content')

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Product Details</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&display=swap" rel="stylesheet">


</head>

    <section class="product-container">

        

        <div class="product-image">

            <img src="{{ $product->image_url }}" alt="{{ $product->mug_name }}" id="productImage">

        </div>

        <div class="product-details">

           <span class="product-category">
               {{ $product->category->name ?? __('messages.uncategorized') }}
           </span>

            <h1 id="productName">
                {{ $product->mug_name }}
            </h1>

            <h2 id="productPrice">
                {{ $product->price }} EGP
            </h2>

           

            <p class="description" id="productDescription">
                {{ $product->description }}
            </p>


            <div class="info-box">

                <h3>{{ __('messages.capacity') }}</h3>

                <p id="productCapacity">
                    {{ $product->capacity }}
                </p>

            </div>


            <div class="info-box">

                <h3>{{ __('messages.microwave_safe') }}</h3>

                <p id="productMicrowave">
                    {{ $product->microwave
                    ? __('messages.yes')
                    : __('messages.no') }}
                </p>

            </div>


            <div class="info-box">

                <h3>{{ __('messages.how_its_made') }}</h3>

                <p id="producthowItsMade">
                    {{ $product->how_its_made }}
                </p>

            </div>

            <div class="quantity-section">

                <h3>{{ __('messages.quantity') }}</h3>

                <div class="quantity-box">

                    <button id="minus">-</button>

                    <span id="quantity">1</span>

                    <button id="plus">+</button>

                </div>

            </div>

            <div class="product-buttons">
                
                <button  type='button' class='cart-btn' id='addCart' data-product-id='{{ $product->id }}'>

                    {{ __('messages.add_to_cart') }}

                </button>

     
            <button type="button" class="buy-btn" id="buyNow">
              {{ __('messages.buy_now') }}
           </button>

            </div>

            <div class="extra-info">

                <div class="extra-card">

                    <h4>{{ __('messages.materials') }}</h4>

                    <p>
                       {{ __('messages.materials_description') }}
                    </p>

                </div>

                <div class="extra-card">

                    <h4>{{ __('messages.care_instructions') }}</h4>

                    <p>
                        {{ __('messages.care_description') }}
                    </p>

                </div>

                <div class="extra-card">

                    <h4>{{ __('messages.shipping') }}</h4>

                    <p>
                       {{ __('messages.shipping_description') }}
                    </p>

                </div>

            </div>

        </div>

    </section>
 

    <div class="back-section">

        <a href="{{ route('collection') }}" class="back-btn">

            ← {{ __('messages.back_to_collection') }}

        </a>

    </div>

    <script>
        const product = @json($product);
        const isLoggedIn = @json(auth()->check());
    </script>
    
    <script>
      const translations = {
        loginToAddCart: @json(__('messages.login_to_add_cart')),
        loginToBuy: @json(__('messages.login_to_buy')),
      };
   </script>

    <script src="js/bootstrap.bundle.min.js"></script>
    @vite('resources/js/product.js')


@endsection