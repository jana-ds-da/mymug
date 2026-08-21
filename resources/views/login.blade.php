@extends('layouts.app')

@section('title','login')

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

            <h1>Log in to your account</h1>

            <form class="login-form" method= 'POST' action='{{ route('login.store') }}'>
                @csrf
                <div class="field">
                    <label for="email">Email </label>
                    <input type="email" id="email" name="email" required>
                    @error('email')
                        <span class='error-text'>{{ $message }}</span>
                    @enderror    
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    @error('password')
                        <span class='error-text'>{{ $message }}</span>
                    @enderror    
                </div>

                <a href="#" class="forgot-link">Forgot your password?</a>

                <button type="submit" class="login-btn">Log In</button>
            </form>

            <p class="signup-text">
                New to my mug? <a href="{{ route('signup') }}" class="signup-link">
                                       Create an account
                                </a>
            </p>
        </div>
    </div>
  <script src="js/bootstrap.bundle.min.js"></script>



@endsection