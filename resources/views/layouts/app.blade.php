<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name='csrf-token' content='{{ csrf_token() }}'>

    <title>@yield('title')</title>
    

    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

    @yield('css') 


</head>

<body>
    @include('components.navbar')
    @yield('content')
 
    
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>    
@stack('scripts')
</body>

</html>