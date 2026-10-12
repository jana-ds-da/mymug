
@extends('layouts.app')

@section('title', __('messages.categories'))

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
@endsection

@section('content')

<main class="dashboard">

    <section class="product-management">

        @if(session('success'))
            <div class="success_message">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="error_message">
                {{ session('error') }}
            </div>
        @endif

        <div class="card-header">

            <div>
                <h2>{{ __('messages.manage_categories') }}</h2>
                <span>{{ __('messages.view_manage_categories') }}</span>
            </div>

        

        </div>

         @can('create categories')
                <a href="{{ route('category.create') }}" class="users">
                   {{ __('messages.create_category') }}
                </a>
            @endcan

        {{ $dataTable->table() }}

    </section>

</main>

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush

@vite('resources/js/dashboard.js')

@endsection
