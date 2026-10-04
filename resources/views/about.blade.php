@extends('layouts.app')

@section('title','about')

@section('css')
   <link rel='stylesheet' href='{{ asset('css/about.css') }}'>
@endsection   

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Mug | About</title>

    <meta name="description" content="Handcrafted ceramic mugs made with care.">
    <meta name="keywords" content="mugs, ceramics, handmade">
    <meta name="author" content="Jana Muhammad">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body>



<main class="main-layout">

    

    <section class="left-column">

        <div class="story-intro">

            <p class="eyebrow">
                <span class="eyebrow-line"></span>
                {{ __('messages.our_story') }}
            </p>

            <h2 class="story-heading">
                {{ __('messages.beauty_of_handcrafted_moments') }}
            </h2>

        </div>

        <section class="craft-content">

            <div class="process-gallery">

                <figure class="process-shot">
                    <img src="{{ asset('img/about1.jpeg') }}" class="process-img">
                    <figcaption>{{ __('messages.studio_views_sourcing') }}</figcaption>
                </figure>

                <figure class="process-shot">
                    <img src="{{ asset('img/about2.jpeg') }}" class="process-img">
                    <figcaption>{{ __('messages.forming') }}</figcaption>
                </figure>

                <figure class="process-shot">
                    <img src="{{ asset('img/about3.jpeg') }}" class="process-img">
                    <figcaption>{{ __('messages.glazing') }}</figcaption>
                </figure>

                <figure class="process-shot">
                    <img src="{{ asset('img/about4.jpeg') }}" class="process-img">
                    <figcaption>{{ __('messages.firing') }}</figcaption>
                </figure>

            </div>

            <div class="craft-right">

                <div class="craft-text">

                    <h3>{{ __('messages.from_earth_to_table') }}</h3>

                    <p>
                        {{ __('messages.about_paragraph_1') }}
                    </p>

                    <p>
                        {{ __('messages.about_paragraph_2') }}
                    </p>

                    <p>
                        {{ __('messages.about_paragraph_3') }}
                    </p>

                    <p>
                        {{ __('messages.about_paragraph_4') }}
                    </p>

                </div>

                <div class="gallery-actions">

                    <a href="{{ route('collection') }}" class="btn-solid">
                        {{ __('messages.browse_collection') }}
                    </a>

                </div>

            </div>

        </section>

    </section>
        
    <aside class="right-column">

        <div class="hero-photo-wrapper">

            <img src="{{ asset("img/about5.jpeg") }}"
                 alt="{{ __('messages.pottery_studio') }}"
                 class="hero-img">

            

        </div>

        <div class="product-showcase-row">

            <img src="{{ asset('img/about6.jpeg') }}"
                 class="product-img"
                 alt="{{ __('messages.mug') }}">

            <img src="{{ asset('img/about7.jpeg') }}"
                 class="product-img"
                 alt="{{ __('messages.mug') }}">

            <img src="{{ asset('img/about8.jpeg') }}"
                 class="product-img"
                 alt="{{ __('messages.mug') }}">

        </div>

        <div class="community-footer">

            <p class="community-text">
               {{ __('messages.community_text') }}
            </p>

            

        </div>

    </aside>

</main>
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>

@endsection