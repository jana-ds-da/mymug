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
            <a href="{{ route('home') }}">{{ __('messages.home') }}</a>
        </li>

        <li>
            <a href="{{ route('collection') }}">{{ __('messages.collection') }}</a>
        </li>

        <li>
            <a href="{{ route('about') }}">{{ __('messages.about') }}</a>
        </li>

        <li>
            <a href="{{ route('cart') }}">{{ __('messages.cart') }}</a>
        </li>

         @can('view dashboard')
            <li>
                <a href="{{ route('dashboard') }}">{{ __('messages.dashboard') }}</a>
            </li>
        @endcan

        @can('view users')
            <li>
                <a href="{{ route('users.index') }}">{{ __('messages.users') }}</a>
            </li>
        @endcan

        @can('view roles')
            <li>
                <a href="{{ route('roles.index') }}">{{ __('messages.roles') }}</a>
            </li>
        @endcan
         

       @can('view departments')
           <li>
               <a href="{{ route('departments.index') }}">
                     {{ __('messages.departments') }}
               </a>
           </li>
       @endcan

        @can('view orders')
            <li>
                <a href="{{ route('orders.index') }}">
                     {{ __('messages.all_orders') }}
                </a>
            </li>
        @endcan
      
        @role('Customer')
         <li>
          <a href="{{ route('orders.my') }}">
              {{ __('messages.my_orders') }}
           </a>
         </li>  
        @endrole
      

         </ul>

</aside>


<div class="auth-links">

     <div class="language-switcher">
        <a href="{{ route('language', 'en') }}"
           class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">
            EN
        </a>
            <span>|</span>

        <a href="{{ route('language', 'ar') }}"
           class="{{ app()->getLocale() === 'ar' ? 'active' : '' }}">
            AR
        </a>
    </div>

    @if(auth()->check())

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="auth-button">
                {{ __('messages.logout') }}
            </button>
        </form>

    @else

        <a href="{{ route('login') }}" class="auth-button">
            {{ __('messages.login') }}
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