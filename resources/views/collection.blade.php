@extends('layouts.app')

@section('title','collection')

@section('css')
   <link rel='stylesheet' href='{{ asset('css/collection.css') }}'>
@endsection   

@section('content')

    <div class="products">

        <h1>My Mug</h1>

        <div class="title">

            <h2>
                <span class="black">{{ __('messages.our_mugs') }}</span>
                <span class="orange">{{ __('messages.crafted_by_hand') }}</span>
            </h2>

            <p class="description">
                  {{ __('messages.collection_description') }}
            </p>

        </div>

    </div>

    <div class="filter-section">

        <a href='{{ route('collection') }}' class='filter-btn {{ !request('category') ? 'active' : '' }}'>
           {{ __('messages.all') }}
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

         <div class="product-card" data-category="{{ $product->category }}">

            <a href="{{ route('product.show', $product->id) }}">

                <img class="product-img"
                     src="{{ $product->image_url }}"
                     alt="{{ $product->mug_name }}">

                <div class="product-info">

                    <h3>{{ $product->mug_name }}</h3>

                    <span class="price">
                        {{ $product->price }} EGP
                    </span>

                </div>

            </a>

        </div>

    @endforeach

</div>

<script src="js/bootstrap.bundle.min.js"></script>
@vite('resources/js/collection.js')

@endsection