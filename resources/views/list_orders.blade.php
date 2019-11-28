<html>
    <body>
        <h1>Orders</h1>
        <ul>
          @foreach ($orders as $order)
            <li><a href="{!! url('/orders/'.$order->order_id); !!}">Order Id: {{ $order->order_id }} - Number: {{ $order->order_number }}</a></li>
          @endforeach
        </ul>
    </body>
</html>
