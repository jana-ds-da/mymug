<button class="menu-toggle" id="menuToggle">
    <span></span>
    <span></span>
    <span></span>
</button>

<aside class="sidebar" id="sidebar">

     <button class="sidebar-close" id="sidebarClose">
        <i class="fas fa-arrow-left"></i>
    </button>

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
         

       @can('view departments')
           <li>
               <a href="{{ route('departments.index') }}">
                     Departments
               </a>
           </li>
       @endcan
      

         </ul>

</aside>


<div class="auth-links">

    @if(auth()->check())

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="auth-button">
                Log Out
            </button>
        </form>

    @else

        <a href="{{ route('login') }}" class="auth-button">
            Log In
        </a>

    @endif

</div>


<script>
  document.addEventListener('DOMContentLoaded', function () {

    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarClose = document.getElementById('sidebarClose');

    menuToggle.addEventListener('click', function () {
        sidebar.classList.add('active');
        menuToggle.classList.add('inside-sidebar');
    });

    sidebarClose.addEventListener('click', function () {
        sidebar.classList.remove('active');
        menuToggle.classList.remove('inside-sidebar');
    });

});
</script>