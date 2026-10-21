@extends('layouts.app')

@section('title', 'Order Details')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')

<div class="dashboard">

    <div class="welcome-section">
        <div>
            <h1>Order #{{ $order->id }}</h1>
            <p>View order details and purchased products.</p>
        </div>

        <a href="{{ url()->previous() }}" class="show-btn">
            Back
        </a>
    </div>

    
    <div class="orders-card">
        <div class="card-header">
            <h2>Customer Information</h2>
        </div>

        <div style="padding: 20px;">
            <p>
                <strong>Name:</strong>
                {{ $order->full_name }}
            </p>

            <p>
                <strong>Email:</strong>
                {{ $order->email ?? '-' }}
            </p>

            <p>
                <strong>Phone:</strong>
                {{ $order->phone ?? '-' }}
            </p>

            <p>
                <strong>Address:</strong>
                {{ $order->address ?? '-' }}
            </p>

            <p>
                <strong>Order Date:</strong>
                {{ $order->created_at->format('d/m/Y h:i A') }}
            </p>

            <p>
                <strong>Payment Method:</strong>
                {{ $order->payment ?? '-' }}
            </p>

            <p>
                <strong>Status:</strong>
                {{ ucfirst($order->status) }}
            </p>
        </div>
    </div>

    
    <div class="orders-card" style="margin-top: 25px;">

        <div class="card-header">
            <h2>Ordered Products</h2>
        </div>

        <div class="orders-table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($order->items as $item)
                        <tr>
                            <td>
                                {{ $item->product->mug_name ?? 'Product unavailable' }}
                            </td>

                            <td>
                                {{ $item->quantity }}
                            </td>

                            <td>
                                {{ number_format(
                                    $item->price ?? $item->product?->price ?? 0,
                                    2
                                ) }} EGP
                            </td>

                            <td>
                                {{ number_format(
                                    $item->quantity *
                                    ($item->price ?? $item->product?->price ?? 0),
                                    2
                                ) }} EGP
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                No products found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="3" style="text-align: right;">
                            <strong>Order Total</strong>
                        </td>

                        <td>
                            <strong>
                                {{ number_format($order->total, 2) }} EGP
                            </strong>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>

</div>

@endsection