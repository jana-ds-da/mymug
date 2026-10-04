@extends('layouts.app')

@section('title', isset($department) ? 'Edit Department' : 'Create Department')

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

        <h1>
            {{ isset($department)  ? __('messages.edit_department'):  __('messages.create_department')}}
        </h1>

        <form class="login-form"
              method="POST"
              action="{{ isset($department)
                     ? route('departments.update', $department->id)
                     : route('departments.store') }}"
             >        

            @csrf

            @if(isset($department))
                @method('PUT')
            @endif


            
            <div class="field">

                <label for="name">
                    {{ __('messages.department_name') }}
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $department->name ?? '') }}"
                    placeholder="{{ __('messages.enter_department_name') }}"
                    required
                >

                @error('name')
                    <span class="error-text">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            
            <div class="field">

                <label for="status">
                    {{ __('messages.status') }}
                </label>

                <select
                    id="status"
                    name="status"
                    required
                    style="
                        width: 100%;
                        padding: 12px;
                        border: 1px solid #ddd;
                        border-radius: 8px;
                        background: white;
                    "
                >

                    <option
                        value="1"
                        {{ old('status', isset($department) ? $department->status : 1) == 1 ? 'selected' : '' }}
                    >
                        {{ __('messages.active') }}
                    </option>

                    <option
                        value="0"
                        {{ old('status', isset($department) ? $department->status : 1) == 0 ? 'selected' : '' }}
                    >
                        {{ __('messages.inactive') }}
                    </option>

                </select>

                @error('status')
                    <span class="error-text">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            
            <button type="submit" class="login-btn">

                {{ isset($department)
                    ? __('messages.update_department')
                    : __('messages.create_department') }}

            </button>

        </form>


        
        <p class="signup-text">

            <a href="{{ route('departments.index') }}"
               class="signup-link">

                {{ __('messages.back_to_departments') }}

            </a>

        </p>

    </div>

</div>

@endsection