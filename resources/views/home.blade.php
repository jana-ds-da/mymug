@extends('layouts.app') 

@section('title','home')

@section('css')
   <link rel='stylesheet' href='{{ asset('css/home.css') }}'>
@endsection   

@section('content')
 
    <div class="hero">

    

        <div class="text">

            <p class="small-title">
                {{ __('messages.home_small_title') }}
            </p>

            <h1>
                {{ __('messages.home_heading_1') }} <br>
                {{ __('messages.home_heading_2') }} <br>
                <span>{{ __('messages.home_heading_3') }}</span>
            </h1>

        </div>

    </div>

    
<p class="description">
    {{ __('messages.home_description_1') }}
    <br>
    {{ __('messages.home_description_2') }} 
    <br>
    {{ __('messages.home_description_3') }}
</p>

   
    <div class="hero-actions">

        <a href="{{ route('collection') }}" style="background-color:#B85C2F; color:white; text-decoration:none; padding:10px 20px; display:inline-block; border-radius:5px;">
                 {{ __('messages.shop_mugs') }}
        </a>
        <a href="{{ route('about') }}" style="color:#B85C2F; text-decoration:none;">
            {{ __('messages.see_how_made') }}
        </a>

    </div>
   
<script src="js/bootstrap.bundle.min.js"></script>
@endsection