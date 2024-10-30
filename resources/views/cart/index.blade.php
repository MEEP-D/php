@extends('layouts.app')

@section('content')
    <style>
        /* Thêm CSS tùy chỉnh */
        .cart-table {
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
        }

        .cart-table thead {
            background-color: #007bff;
            color: white;
        }

        .cart-table th, .cart-table td {
            padding: 15px;
            text-align: center;
        }

        .cart-table tbody tr {
            transition: background-color 0.3s;
        }

        .cart-table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .alert-info {
            font-weight: bold;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-success {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .text-right {
            margin-top: 20px;
        }

        input[type="number"] {
            width: 60px;
            text-align: center;
        }
    </style>

    <h1 class="text-center mb-4">Giỏ Hàng</h1>

    @if(empty($cart))
        <div class="alert alert-info text-center">
            <p>Giỏ hàng của bạn đang trống.</p>
        </div>
    @else
        <div class="cart-table">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalAmount = 0; // Khởi tạo tổng tiền
                    @endphp
                    @foreach($cart as $id => $item)
                        @php
                            $itemTotal = $item['price'] * $item['quantity']; // Tính tổng tiền cho từng sản phẩm
                            $totalAmount += $itemTotal; // Cộng dồn vào tổng tiền
                        @endphp
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>
                                <form action="{{ route('cart.update', $id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control" style="display: inline;">
                                    <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                                </form>
                            </td>
                            <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                            <td>{{ number_format($itemTotal, 0, ',', '.') }} VNĐ</td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Hiển thị tổng tiền -->
        <div class="alert alert-info text-right">
            <strong>Tổng tiền: {{ number_format($totalAmount, 0, ',', '.') }} VNĐ</strong>
        </div>

        <div class="text-right">
            <a href="{{ route('checkout.index') }}" class="btn btn-success">Thanh toán</a>
        </div>
    @endif
@endsection
