@extends('layouts.app') 

@section('title','home')

@section('css')
   <link rel='stylesheet' href='{{ asset('css/home.css') }}'>
@endsection   

@section('content')
 
 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Mug</title>

    <meta name="description"
        content="An online store selling high-quality mugs in a variety of designs — perfect for personal use or as a gift.">

    <meta name="keywords" content="mugs, ice coffee cups">
    <meta name="author" content="Jana Muhammad">
    

    <link rel="stylesheet" href="css/bootstrap.min.css">

  
</head>

<body>

 
    <div class="hero">

    

        <div class="text">

            <p class="small-title">
                SMALL-BATCH STONEWARE
            </p>

            <h1>
                Mugs made <br>
                to hold your <br>
                <span>morning ritual.</span>
            </h1>

        </div>

    </div>

    
<p class="description">
    Handmade mugs crafted with love and care. 
    <br>
    Designed to bring warmth to your everyday 
    <br>
    rituals and simple moments.
</p>

   
    <div class="hero-actions">

        <a href="{{ route('collection') }}" style="background-color:#B85C2F; color:white; text-decoration:none; padding:10px 20px; display:inline-block; border-radius:5px;">
                 SHOP MUGS
        </a>
        <a href="{{ route('about') }}" style="color:#B85C2F; text-decoration:none;">
            See how they're made →
        </a>

    </div>

<script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>

@endsection