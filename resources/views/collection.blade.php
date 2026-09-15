@extends('layouts.app')

@section('title', 'collection')

@section('css')
    <link rel='stylesheet' href='{{ asset('css/collection.css') }}'>
@endsection

@section('content')



    <head>
        <meta charset="utf-8">
        <title>My Mug</title>

        <meta name="description"
            content="An online store selling high-quality mugs in a variety of designs — perfect for personal use or as a gift.">

        <meta name="keywords" content="mugs, ice coffee cups">
        <meta name="author" content="Jana Muhammad">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/collection.css">
    </head>


    <div class="products">

        <h1>My Mug</h1>

        <div class="title">

            <h2>
                <span class="black">Our Mugs</span>
                <span class="orange">crafted by hand</span>
            </h2>

            <p class="description">
                A curated collection of small-batch stoneware.
                Each piece is unique, bringing a touch of art to your daily ritual.
            </p>

        </div>

    </div>




    <div class="filter-section">

        <a href='{{ route('collection') }}' class='filter-btn {{ !request('category') ? 'active' : '' }}'>
            All
        </a>

        @foreach ($categories as $cat)
            <a href='{{ route('collection', ['category' => $cat->slug]) }}'
                class='filter-btn {{ request('category') == $cat->slug ? 'active' : '' }}'>
                {{ $cat->name }}
            </a>
        @endforeach

    </div>





    <div class="mugs-grid" id="mugsGrid">

        @foreach ($products as $product)
            <div class='product-card' data-category='{{ $product->category }}'>
                <a href='{{ route('product.show', $product->id) }}'>
                    <img class='product-img' src='{{ $product->image_url }}' alt='{{ $product->mug_name }}'>

                    <div class='product-info'>
                        <h3>{{ $product->mug_name }}</h3>


                        <span class='price'>{{ $product->price }} EGP </span>

                    </div>

                </a>
            </div>
        @endforeach
    </div>




    <script src="js/bootstrap.bundle.min.js"></script>
    @vite('resources/js/collection.js')




@endsection
