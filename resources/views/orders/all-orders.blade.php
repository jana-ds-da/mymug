@extends('layouts.app')

@section('title', __('messages.all_orders'))

@section('css')
   <link rel='stylesheet' href={{ asset('css/dashboard.css') }}>
@endsection  


@section('content')

<div class="dashboard">

    <div class="welcome-section">
        <div>
            <h1>{{ __('messages.all_orders') }}</h1>
            <p>{{ __('messages.manage_all_orders') }}</p>
        </div>
    </div>

    <div class="stats-section">

        <div class="stat-card">
            <h4>{{ __('messages.all_orders') }}</h4>
            <h2>{{ $orders->count() }}</h2>
            
        </div>

        <div class="stat-card">
            <h4>{{ __('messages.pending') }}</h4>
            <h2>{{ $orders->where('status', 'pending')->count() }}</h2>
            
        </div>

        <div class="stat-card">
            <h4>{{ __('messages.preparing') }}</h4>
            <h2>{{ $orders->where('status', 'preparing')->count() }}</h2>
            
        </div>

        <div class="stat-card">
            <h4>{{ __('messages.delivered') }}</h4>
            <h2>{{ $orders->where('status', 'delivered')->count() }}</h2>
            
        </div>

    </div>

    <div class="orders-card">

        <div class="card-header">
            <h2>{{ __('messages.all_orders') }}</h2>
            <span>{{ $orders->count() }} {{ __('messages.orders') }}</span>
        </div>

        <div class="orders-table-wrapper">

            <table>

                <thead>
                    <tr>
                        <th>{{ __('messages.order_number') }} #</th>
                        <th>{{ __('messages.customer') }}</th>
                        <th>{{ __('messages.product') }}</th>
                        <th>{{ __('messages.qty') }}</th>
                        <th>{{ __('messages.total') }}</th>
                        <th>{{ __('messages.payment') }}</th>
                        <th>{{ __('messages.date') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.actions') }}</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($orders as $order)

                        @foreach($order->items as $item)

                            <tr id="order-row-{{ $order->id }}">

                                <td>
                                    #{{ $order->id }}
                                </td>

                                <td>
                                    {{ $order->full_name }}
                                </td>

                                <td>
                                    {{ $item->product->mug_name ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->quantity }}
                                </td>

                                <td>
                                    {{ number_format($order->total, 2) }}
                                </td>

                                <td>
                                    {{ $order->payment }}
                                </td>

                                <td>
                                    {{ $order->created_at->format('d/m') }}
                                </td>

                                <td>
                                    <select
                                        class="order-status"
                                        data-order-id="{{ $order->id }}"
                                    >
                                        <option value="pending"
                                            {{ $order->status === 'pending' ? 'selected' : '' }}>
                                            {{ __('messages.pending') }}
                                        </option>

                                        <option value="preparing"
                                            {{ $order->status === 'preparing' ? 'selected' : '' }}>
                                            {{ __('messages.preparing') }}
                                        </option>

                                        <option value="delivered"
                                            {{ $order->status === 'delivered' ? 'selected' : '' }}>
                                            {{ __('messages.delivered') }}
                                        </option>
                                    </select>
                                </td>

                                <td>
                                    <button
                                        type="button"
                                        class="delete-btn delete-order"
                                        data-order-id="{{ $order->id }}"
                                    >
                                        {{ __('messages.delete') }}
                                    </button>
                                </td>

                            </tr>

                        @endforeach

                    @empty

                        <tr>
                            <td colspan="9" class="text-center">
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

@push('scripts')
    @vite('resources/js/orders.js')
@endpush