@extends('layouts.app')

@section('title', 'Order Receipt')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/receipt.css') }}">
@endsection

@section('content')

<div class="receipt-page">

    <div class="receipt">

        <h1>My Mug — Order Receipt</h1>

        <div class="order-info">

            <p>
                Order #MM-{{ $order->id }}
            </p>

            <p>
                Date: {{ $order->created_at->format('d/m/Y') }}
            </p>

        </div>

        <hr>

        <div class="customer-info">

            <p>
                <strong>Name:</strong>
                {{ $order->full_name }}
            </p>

            <p>
                <strong>Email:</strong>
                {{ $order->email }}
            </p>

            <p>
                <strong>Phone:</strong>
                {{ $order->phone }}
            </p>

            <p>
                <strong>City:</strong>
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
            Total: {{ number_format($order->total, 2) }} EGP
        </div>

    </div>

    <div class="receipt-buttons">

        <button  type='button' id="print-btn">
            Print / Save as PDF
        </button>


        @vite('resources/js/receipt.js')

        <a href="{{ route('collection') }}">
            Continue Shopping
        </a>

    </div>

</div>



@endsection

