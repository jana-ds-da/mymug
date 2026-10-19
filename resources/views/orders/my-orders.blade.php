@extends('layouts.app')

@section('title', __('messages.my_orders'))

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')

<div class="dashboard">

    <div class="welcome-section">
        <div>
            <h1>{{ __('messages.my_orders') }}</h1>
            <p>{{ __('messages.track_your_orders') }}</p>
        </div>
    </div>

 

    <div class="orders-card">

        <div class="card-header">
            <h2>{{ __('messages.my_orders') }}</h2>
            <span>{{ $orders->count() }} {{ __('messages.orders') }}</span>
        </div>

    
<div class="orders-table-wrapper">

    <table>

        <thead>
            <tr>
                <th>{{ __('messages.order_number') }} #</th>
                <th>{{ __('messages.product') }}</th>
                <th>{{ __('messages.qty') }}</th>
                <th>{{ __('messages.total') }}</th>
                <th>{{ __('messages.payment') }}</th>
                <th>{{ __('messages.date') }}</th>
                <th>{{ __('messages.status') }}</th>
            </tr>
        </thead>

        <tbody>

            @forelse($orders as $order)

                <tr>

                  
                    <td>
                        #{{ $order->id }}
                    </td>

                   
                    <td>
                        @foreach($order->items as $item)
                            <div style="margin-bottom: 6px;">
                                {{ $item->product->mug_name ?? '-' }}
                            </div>
                        @endforeach
                    </td>

                   
                    <td>
                        @foreach($order->items as $item)
                            <div style="margin-bottom: 6px;">
                                {{ $item->quantity }}
                            </div>
                        @endforeach
                    </td>

                    
                    <td>
                        {{ number_format($order->total, 2) }} EGP
                    </td>

                   
                    <td>
                        {{ $order->payment }}
                    </td>

                   
                    <td>
                        {{ $order->created_at->format('d/m/Y') }}
                    </td>

                    
                    <td>
                        <span class="order-status status-{{ $order->status }}">
                            {{ __('messages.' . $order->status) }}
                        </span>
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7" class="text-center">
                        {{ __('messages.no_orders_found') }}
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>


    </div>

</div>

@endsection