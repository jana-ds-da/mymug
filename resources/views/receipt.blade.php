@extends('layouts.app')

@section('title',  __('messages.order_receipt'))

@section('css')
    <link rel="stylesheet" href="{{ asset('css/receipt.css') }}">
@endsection

@section('content')

<div class="receipt-page">

    <div class="receipt">

        <h1>My Mug — {{ __('messages.order_receipt')  }}</h1>

        <div class="order-info">

            <p>
                {{ __('messages.order_number') }} #MM-{{ $order->id }}
            </p>

            <p>
                {{ __('messages.date') }}: {{ $order->created_at->format('d/m/Y') }}
            </p>

        </div>

        <hr>

        <div class="customer-info">

            <p>
                <strong>{{ __('messages.name') }}:</strong>
                {{ $order->full_name }}
            </p>

            <p>
                <strong>{{ __('messages.email') }}:</strong>
                {{ $order->email }}
            </p>

            <p>
                <strong>{{ __('messages.phone') }}:</strong>
                {{ $order->phone }}
            </p>

            <p>
                <strong>{{ __('messages.city') }}:</strong>
                {{ $order->city }}
            </p>

        </div>

        <hr>

        <div class="order-items">

            @foreach($order->items as $item)

                <p>
                    {{ $item->product->mug_name }}
                    × {{ $item->quantity }}
                    — {{ number_format($item->total_price, 2) }} EGP
                </p>

            @endforeach

        </div>

        <hr>

        <div class="total">
            {{ __('messages.total') }}: {{ number_format($order->total, 2) }} EGP
        </div>

    </div>

    <div class="receipt-buttons">

        <button  type='button' id="print-btn">
            {{ __('messages.print_save_pdf') }}
        </button>


        @vite('resources/js/receipt.js')

        <a href="{{ route('collection') }}">
            {{ __('messages.continue_shopping') }}
        </a>

    </div>

</div>

@endsection

