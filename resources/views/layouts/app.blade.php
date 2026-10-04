<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name='csrf-token' content='{{ csrf_token() }}'>

    <title>@yield('title', 'My Mug')</title>
    

    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    @yield('css') 

   <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    @include('components.navbar')
    <main class="page-content">
        @yield('content')
    </main>
 
    
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>    
@stack('scripts')
</body>

</html>