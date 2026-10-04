@extends('layouts.app')

@section('title', 'Departments')

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
                <h2>{{ __('messages.manage_departments') }}</h2>
                <span>{{ __('messages.view_manage_departments') }}</span>
            </div>

            <div class="d-flex gap-2">

                @can('create departments')
                    <a href="{{ route('departments.create') }}" class="users">
                        {{ __('messages.create_department') }}
                    </a>
                @endcan

            </div>

        </div>

        {{ $dataTable->table() }}

    </section>

</main>

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush

@vite('resources/js/dashboard.js')

@endsection