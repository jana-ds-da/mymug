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
                <h2>Manage Roles</h2>
                <span>View & Manage Roles</span>
            </div>

            @can('manage roles')
                <a href="{{ route('roles.create') }}" class="users">
                    Create Role
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