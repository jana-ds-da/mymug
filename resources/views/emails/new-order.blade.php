<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Order - My Mug</title>
</head>

<body>

    <h1>My Mug - New Order</h1>

    <h2>Order #MM-{{ $order->id }}</h2>

    <hr>

    <h3>Customer Information</h3>

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
        <strong>Address:</strong>
        {{ $order->address }}
    </p>

    <p>
        <strong>City:</strong>
        {{ $order->city }}
    </p>

    <hr>

    <h3>Order Items</h3>

    @foreach($order->items as $item)

        <p>
            <strong>{{ $item->product->mug_name }}</strong>

            × {{ $item->quantity }}

            — {{ number_format($item->total_price, 2) }} EGP
        </p>

    @endforeach

    <hr>

    <p>
        <strong>Payment Method:</strong>
        {{ $order->payment }}
    </p>

    <h2>
        Total:
        {{ number_format($order->total, 2) }} EGP
    </h2>

</body>
</html>