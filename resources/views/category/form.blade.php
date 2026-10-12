@extends('layouts.app')

@section('title', isset($category) ? __('messages.edit_category') : __('messages.create_category'))

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
            {{ isset($category)
                ? __('messages.edit_category')
                : __('messages.create_category') }}
        </h1>

        <form class="login-form"
              method="POST"
              action="{{ isset($category)
                    ? route('category.update', $category->id)
                    : route('category.store') }}">

            @csrf

            @if(isset($category))
                @method('PUT')
            @endif

            
            <div class="field">

                <label for="name_en">
                    {{ __('messages.category_name_en') }}
                </label>

                <input
                    type="text"
                    id="name_en"
                    name="name[en]"
                    value="{{ old('name.en', isset($category) ? $category->translate('en')?->name : '') }}"
                    placeholder="{{ __('messages.enter_category_name_en') }}"
                    required
                >

                @error('name.en')
                    <span class="error-text">
                        {{ $message }}
                    </span>
                @enderror

            </div>

          
            <div class="field">

                <label for="name_ar">
                    {{ __('messages.category_name_ar') }}
                </label>

                <input
                    type="text"
                    id="name_ar"
                    name="name[ar]"
                    value="{{ old('name.ar', isset($category) ? $category->translate('ar')?->name : '') }}"
                    placeholder="{{ __('messages.enter_category_name_ar') }}"
                    dir="rtl"
                    required
                >

                @error('name.ar')
                    <span class="error-text">
                        {{ $message }}
                    </span>
                @enderror

            </div>

            
           

            <button type="submit" class="login-btn">

                {{ isset($category)
                    ? __('messages.update_category')
                    : __('messages.create_category') }}

            </button>

        </form>

        <p class="signup-text">

            <a href="{{ route('category.index') }}"
               class="signup-link">

                {{ __('messages.back_to_categories') }}

            </a>

        </p>

    </div>

</div>

@endsection
