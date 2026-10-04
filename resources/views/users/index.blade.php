@extends('layouts.app')

@section('title', 'Users')

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

        <div class="card-header">

            <div>
                <h2>{{ __('messages.manage_users') }}</h2>
                <span>{{ __('messages.view_manage_users') }}</span>
            </div>
         
        <div class="d-flex gap-2">  
            @can('manage users')
                <a href="{{ route('users.create') }}" class="users">
                    {{ __('messages.create_user') }}
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

@vite('resources/js/users.js')
@vite('resources/js/dashboard.js')

@endsection

