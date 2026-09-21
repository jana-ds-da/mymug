<button class="menu-toggle" id="menuToggle">
    <span></span>
    <span></span>
    <span></span>
</button>

<aside class="sidebar" id="sidebar">

    <h1 class="nav-logo">My Mug</h1>

    <ul class="nav-links">

        <li>
            <a href="{{ route('home') }}">Home</a>
        </li>

        <li>
            <a href="{{ route('collection') }}">Collection</a>
        </li>

        <li>
            <a href="{{ route('about') }}">About</a>
        </li>

        <li>
            <a href="{{ route('cart') }}">Cart</a>
        </li>

         @can('view dashboard')
            <li>
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
        @endcan

        @can('view users')
            <li>
                <a href="{{ route('users.index') }}">Users</a>
            </li>
        @endcan

        @can('view roles')
            <li>
                <a href="{{ route('roles.index') }}">Role</a>
            </li>
        @endcan

       @if(auth()->check())

    <li>
        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit" class="nav-button logout-button">
                Log Out
            </button>
        </form>
    </li>

@else

    <li>
        <a href="{{ route('login') }}" class="nav-button login-button">
            Log In
        </a>
    </li>

@endif

         </ul>

</aside>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');

        menuToggle.addEventListener('click', function () {
            sidebar.classList.toggle('active');
            menuToggle.classList.toggle('inside-sidebar');
        });

    });
</script>