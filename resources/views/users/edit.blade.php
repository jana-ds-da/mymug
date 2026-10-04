@extends('layouts.app')

@section('title', 'Edit User')

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

        <h1>{{ __('messages.edit_user') }}</h1>

        <form class="login-form"
              id="editUserForm"
              method="POST"
              action="{{ route('users.update', $user->id) }}">

            @csrf
            @method('PUT')

            
            <div class="field">

                <label for="name">{{ __('messages.name') }}</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    required
                >

                @error('name')
                    <span class="error-text">{{ $message }}</span>
                @enderror

            </div>


            
            <div class="field">

                <label for="email">{{ __('messages.email') }}</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    required
                >

                @error('email')
                    <span class="error-text">{{ $message }}</span>
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
                            {{ old('role', $user->getRoleNames()->first()) == $role->name ? 'selected' : '' }}
                        >
                            {{ $role->name }}
                        </option>

                    @endforeach

                </select>

                @error('role')
                    <span class="error-text">{{ $message }}</span>
                @enderror

            </div>


            <div class="field">
                 <label for="department_id">{{ __('messages.department') }}</label>

                  <select id="department_id" name="department_id" required>
                     <option value="" disabled>{{ __('messages.select_department') }}</option>

                      @foreach ($departments as $department)
                           <option value="{{ $department->id }}"
                               {{ $user->department_id == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                     @endforeach
                   </select>
            </div>


            <button type="submit" class="login-btn">
                {{ __('messages.save_changes') }}
            </button>

        </form>


        <p class="signup-text">

            <a href="{{ route('users.index') }}" class="signup-link">
                {{ __('messages.back_to_users') }}
            </a>

        </p>

    </div>

</div>

@vite('resources/js/users.js')

@endsection