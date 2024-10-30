<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Hỗ trợ ký tự tiếng Anh -->
    <title>Invoice Tienesga NH</title> <!-- Tiêu đề đã cập nhật -->
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 80%; margin: auto; }
        .header, .footer { text-align: center; }
        .header h1 { margin: 0; }
        .footer p { margin: 0; }
        .table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .table th, .table td { border: 1px solid #000; padding: 10px; text-align: left; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>INVOICE</h1> <!-- Tiêu đề đã cập nhật -->
            <p>Date: {{ date('d/m/Y', strtotime($order->created_at)) }}</p>
        </div>

        <div>
            <h2>Order Information</h2>
            <p>Order ID: {{ $order->id }}</p>
            <p>Customer Name: {{ $order->customer_name }}</p>
            <p>Shipping Address: {{ $order->shipping_address }}</p>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @if($order->items && $order->items->isNotEmpty())
                    @php
                        $totalAmount = 0; // Khởi tạo biến tổng
                    @endphp
                    @foreach($order->items as $item)
                        @php
                            $itemTotal = $item->price * $item->quantity; // Tính tổng cho mỗi mục
                            $totalAmount += $itemTotal; 
                        @endphp
                        <tr>
                            <td>{{ $item->shirt->manufacturer }}</td> <!-- Lấy giá trị manufacturer -->
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price, 0, ',', '.') }} VND</td>
                            <td>{{ number_format($itemTotal, 0, ',', '.') }} VND</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" style="text-align: center;">No items in this order.</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <div class="footer">
            <p>Total Amount: {{ number_format($totalAmount, 0, ',', '.') }} VND</p> <!-- Hiển thị tổng số tiền -->
            <p>Thank you for your purchase!</p>
        </div>
    </div>
</body>
</html>
