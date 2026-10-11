@extends('layouts.app')

@section('title',  __('messages.signup'))

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

            <h1>{{ __('messages.create_your_account') }}</h1>

            <form class="login-form"action='{{ route('signup.store') }}' method='post'>
                @csrf
                <div class="field">
                    <label for="name"> {{ __('messages.name') }}</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="field">
                    <label for="email">{{ __('messages.email') }}</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="field">
                    <label for="password"> {{ __('messages.password') }}</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="field">
                     <label for="password_confirmation">{{ __('messages.password_confirmation') }}</label>
                    <input 
                         type="password"
                         id="password_confirmation"
                         name="password_confirmation"
                         required
                    >
                </div>

                <div class="field">
                    <label for="department_id">{{ __('messages.department') }}</label>

                   <select id="department_id" name="department_id" required>
                        <option value="" disabled selected>{{ __('messages.select_department') }}</option>

                        @foreach ($departments as $department)
                           <option value="{{ $department->id }}">
                                {{ $department->name }}
                          </option>
                       @endforeach
                    </select>
         </div>

               <div class="field">
                     <label for="role">{{ __('messages.role') }}</label>
                     <select id="role" name="role" required>
                          <option value="" disabled selected>{{ __('messages.select_role') }}</option>
                           <option value="Customer"> {{ __('messages.customer') }}</option>
                           <option value="Manager">{{ __('messages.manager') }}</option>
                           <option value="Admin">{{ __('messages.admin') }}</option>
                      </select>
                </div>
   


                <button type="submit" class="login-btn">{{ __('messages.signup') }}</button>
            </form>

            <p class="signup-text">
                {{ __('messages.already_have_account') }}
                      <a href="{{ route('login') }}" class="signup-link">
                                       {{ __('messages.login') }}
                                         </a>
            </p>
        </div>
    </div>
  <script src="js/bootstrap.bundle.min.js"></script>

@endsection