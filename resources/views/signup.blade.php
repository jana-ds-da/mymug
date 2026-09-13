@extends('layouts.app')

@section('title', 'Sign Up')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
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

            <h1>create your account</h1>

            <form class="login-form"action='{{ route('signup.store') }}' method='post'>
                @csrf
                <div class="field">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="field">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>

                <button type="submit" class="login-btn">Sign Up</button>
            </form>

            <p class="signup-text">
                Already have an account? <a href="{{ route('login') }}" class="signup-link">
                                       Log In
                                         </a>
            </p>
        </div>
    </div>
  <script src="js/bootstrap.bundle.min.js"></script>

@endsection