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
               {{ $product->category->name ?? 'Uncategorized' }}
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

                <h3>Capacity</h3>

                <p id="productCapacity">
                    {{ $product->capacity }}
                </p>

            </div>


            <div class="info-box">

                <h3>Microwave Safe</h3>

                <p id="productMicrowave">
                    {{ $product->microwave ? 'Yes' : 'No' }}
                </p>

            </div>


            <div class="info-box">

                <h3>How It's Made</h3>

                <p id="producthowItsMade">
                    {{ $product->how_its_made }}
                </p>

            </div>

            <div class="quantity-section">

                <h3>Quantity</h3>

                <div class="quantity-box">

                    <button id="minus">-</button>

                    <span id="quantity">1</span>

                    <button id="plus">+</button>

                </div>

            </div>

            <div class="product-buttons">
                
                <button  type='button' class='cart-btn' id='addCart' data-product-id='{{ $product->id }}'>

                    Add To Cart

                </button>

              <form action='{{ route('cart.add') }}' method='post'>
                @csrf

                 <input type='hidden' name='product_id' value='{{ $product->id }}'>
                 <input type="hidden" name="quantity" value="1">
                 <input type="hidden" name="buy_now" value="1">
                  <button type='submit'  class='buy-btn'>
                      Buy Now
                  </button>
                
               </form>
            </div>

            <div class="extra-info">

                <div class="extra-card">

                    <h4>Materials</h4>

                    <p>
                        Premium handmade ceramic with food-safe glaze.
                    </p>

                </div>

                <div class="extra-card">

                    <h4>Care Instructions</h4>

                    <p>
                        Hand wash recommended. Avoid abrasive cleaners.
                    </p>

                </div>

                <div class="extra-card">

                    <h4>Shipping</h4>

                    <p>
                        Ready to ship within 2–4 business days.
                    </p>

                </div>

            </div>

        </div>

    </section>
 

    <div class="back-section">

        <a href="{{ route('collection') }}" class="back-btn">

            ← Back to Collection

        </a>

    </div>

    <script>
        const product = @json($product);
        const isLoggedIn = @json(auth()->check());
    </script>    

    <script src="js/bootstrap.bundle.min.js"></script>
    @vite('resources/js/product.js')


@endsection