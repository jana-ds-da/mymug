@extends('layouts.app')

@section('title', 'Create User')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')

<div class="bg-overlay"></div>

<div class="login-wrapper">

    <div class="login-card">

        <div class="brand">
            <span class="brand-icon"></span>
            <span class="brand-name">my mug</span>
        </div>

        <h1>{{ __('messages.create_new_user') }}</h1>

        <form
            class="login-form"
            method="POST"
            action="{{ route('users.store') }}"
        >

            @csrf

            <div class="field">

                <label for="name">{{ __('messages.name') }}</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                >

                @error('name')
                    <span class="error-text">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            <div class="field">

                <label for="email">{{ __('messages.email') }}</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                >

                @error('email')
                    <span class="error-text">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            <div class="field">

                <label for="password">{{ __('messages.password') }}</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                >

                @error('password')
                    <span class="error-text">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            <div class="field">

                <label for="role">{{ __('messages.role') }}</label>

                <select
                    id="role"
                    name="role"
                    class="role-select"
                    required
                >

                    <option value="">{{ __('messages.select_role') }}</option>

                    @foreach($roles as $role)

                        <option
                            value="{{ $role->name }}"
                            {{ old('role') == $role->name ? 'selected' : '' }}
                        >
                            {{ $role->name }}
                        </option>

                    @endforeach

                </select>

                @error('role')
                    <span class="error-text">
                        {{ $message }}
                    </span>
                @enderror

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


            <button
                type="submit"
                class="login-btn"
            >
                 {{ __('messages.create_user') }}
            </button>

        </form>


        <p class="signup-text">

            <a
                href="{{ route('users.index') }}"
                class="signup-link"
            >
                {{ __('messages.back_to_users') }}
            </a>

        </p>

    </div>

</div>

@endsection