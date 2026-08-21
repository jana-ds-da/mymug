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
                OUR STORY
            </p>

            <h2 class="story-heading">
                We believe in the beauty
                <br>
                of
                <span class="highlight">
                    handcrafted moments
                </span>
            </h2>

        </div>

        <section class="craft-content">

            <div class="process-gallery">

                <figure class="process-shot">
                    <img src="{{ asset('img/about1.jpeg') }}" class="process-img">
                    <figcaption>Studio Views: Sourcing</figcaption>
                </figure>

                <figure class="process-shot">
                    <img src="{{ asset('img/about2.jpeg') }}" class="process-img">
                    <figcaption>Forming</figcaption>
                </figure>

                <figure class="process-shot">
                    <img src="{{ asset('img/about3.jpeg') }}" class="process-img">
                    <figcaption>Glazing</figcaption>
                </figure>

                <figure class="process-shot">
                    <img src="{{ asset('img/about4.jpeg') }}" class="process-img">
                    <figcaption>Firing</figcaption>
                </figure>

            </div>

            <div class="craft-right">

                <div class="craft-text">

                    <h3>From Earth to Table</h3>

                    <p>
                        A "My Mug" piece starts as nothing more than raw clay and an idea.
                        Every mug is shaped, refined and finished entirely by hand,
                        preserving the warmth and character that only craftsmanship can create.
                    </p>

                    <p>
                        Since 2018, our small studio has focused on quality instead of quantity.
                        Every collection is produced in limited batches using locally sourced clay
                        and carefully selected glazes.
                    </p>

                    <p>
                        Each mug is wheel-thrown by skilled ceramic artists, then dried,
                        glazed and kiln-fired slowly to create a durable finish while
                        preserving its handmade personality.
                    </p>

                    <p>
                        Because every glaze reacts differently inside the kiln,
                        no two mugs are ever exactly alike—and that's what makes every
                        piece unique.
                    </p>

                </div>

                <div class="gallery-actions">

                    <a href="{{ route('collection') }}" class="btn-solid">
                        Browse Collection
                    </a>

                </div>

            </div>

        </section>

    </section>
        
    <aside class="right-column">

        <div class="hero-photo-wrapper">

            <img src="{{ asset("img/about5.jpeg") }}"
                 alt="Pottery Studio"
                 class="hero-img">

            

        </div>

        <div class="product-showcase-row">

            <img src="{{ asset('img/about6.jpeg') }}"
                 class="product-img"
                 alt="Mug">

            <img src="{{ asset('img/about7.jpeg') }}"
                 class="product-img"
                 alt="Mug">

            <img src="{{ asset('img/about8.jpeg') }}"
                 class="product-img"
                 alt="Mug">

        </div>

        <div class="community-footer">

            <p class="community-text">
                Handmade in small batches with care,
                patience and traditional craftsmanship.
                Every piece is designed to make your
                everyday coffee ritual a little more special.
            </p>

            

        </div>

    </aside>

</main>
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>

@endsection