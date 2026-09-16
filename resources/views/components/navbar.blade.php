<header>

    <h1 class="nav-logo">My Mug</h1>

   <ul class="nav-links">
    <li><a href="{{ route('home') }}">Home</a></li>
    @can('view dashboard')
       <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
    @endcan
    <li><a href="{{ route('collection') }}">Collection</a></li>
    <li><a href="{{ route('about') }}">About</a></li>
    <li><a href="{{ route('cart') }}">Cart</a></li>
    @if(auth()->check())
    <li>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-logout">Log Out</button>
        </form>
    </li>
 @else
    <li>
        <a href="{{ route('login') }}">Log In</a>
    </li>
 @endif
   </ul>

</header>