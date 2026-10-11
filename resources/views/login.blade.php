@extends('layouts.app')

@section('title', __('messages.login'))

@section('css')
  <link rel='stylesheet' href='{{ asset('css/login.css') }}'>
@endsection  

@section('content')



    <div class="bg-image"></div>
    <div class="bg-overlay"></div>

    <div class="login-wrapper">
        <div class="login-card">
            <div class="brand">
                <span class="brand-icon"></span>
                <span class="brand-name">my mug</span>
            </div>
            

            @if(session('success'))
                <div class="success_message">
                   {{ session('success') }}
                </div>
            @endif

            
            <h1> {{ __('messages.login_title') }}</h1>

            <form class="login-form" method= 'POST' action='{{ route('login.store') }}'>
                @csrf
                <div class="field">
                    <label for="email">{{ __('messages.email') }} </label>
                    <input type="email" id="email" name="email" required>
                    @error('email')
                        <span class='error-text'>{{ $message }}</span>
                    @enderror    
                </div>

                <div class="field">
                    <label for="password"> {{ __('messages.password') }}</label>
                    <input type="password" id="password" name="password" required>
                    @error('password')
                        <span class='error-text'>{{ $message }}</span>
                    @enderror    
                </div>

                <a href="#" class="forgot-link">{{ __('messages.forgot_password') }}</a>

                <button type="submit" class="login-btn">{{ __('messages.login_button') }}</button>
            </form>

            <p class="signup-text">
                {{ __('messages.new_to_my_mug') }} <a href="{{ route('signup') }}" class="signup-link">
                                        {{ __('messages.create_account') }}
                                </a>
            </p>
        </div>
    </div>
  <script src="js/bootstrap.bundle.min.js"></script>



@endsection