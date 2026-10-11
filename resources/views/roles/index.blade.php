@extends('layouts.app')

@section('title', 'Roles')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')

<main class="dashboard">

    <section class="product-management">

        @if(session('success'))
            <div class="success_message">
                {{ session('success') }}
            </div>
        @endif

        <div class="card-header">

            <div>
                <h2>{{ __('messages.manage_roles') }}</h2>
                <span>{{ __('messages.view_manage_roles') }}</span>
            </div>

            @can('manage roles')
                <a href="{{ route('roles.create') }}" class="users">
                   {{ __('messages.create_role') }}
                </a>
            @endcan

        </div>

        {{ $dataTable->table() }}

    </section>

</main>

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush

@vite('resources/js/roles.js')
@vite('resources/js/dashboard.js')

@endsection