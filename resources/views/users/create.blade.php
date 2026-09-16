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

        <h1>Create a new user</h1>

        <form
            class="login-form"
            method="POST"
            action="{{ route('users.store') }}"
        >

            @csrf

            <div class="field">

                <label for="name">Name</label>

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

                <label for="email">Email</label>

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

                <label for="password">Password</label>

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

                <label for="role">Role</label>

                <select
                    id="role"
                    name="role"
                    class="role-select"
                    required
                >

                    <option value="">Select Role</option>

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


            <button
                type="submit"
                class="login-btn"
            >
                Create User
            </button>

        </form>


        <p class="signup-text">

            <a
                href="{{ route('users.index') }}"
                class="signup-link"
            >
                Back to Users
            </a>

        </p>

    </div>

</div>

@endsection