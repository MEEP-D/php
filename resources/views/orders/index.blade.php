@extends('layouts.app')

@section('content')
    <style>
        /* Thêm CSS tùy chỉnh cho danh sách đơn hàng */
        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem;
            color: #333;
        }

        .search-form {
            margin-bottom: 20px;
            display: flex;
            justify-content: center; /* Căn giữa thanh tìm kiếm */
        }

        .input-group {
            width: 100%; /* Đảm bảo thanh tìm kiếm chiếm toàn bộ chiều rộng */
            max-width: 600px; /* Giới hạn chiều rộng tối đa */
        }

        .table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse; /* Xóa khoảng trống giữa các ô */
            border-radius: 10px;
            overflow: hidden; /* Đảm bảo bo tròn các góc */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Thêm bóng cho bảng */
        }

        .table th,
        .table td {
            text-align: center;
            padding: 12px;
            border: 1px solid #dee2e6; /* Đường viền cho các ô */
        }

        .table th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2; /* Màu nền cho các hàng chẵn */
        }

        .table tr:hover {
            background-color: #e9ecef; /* Hiệu ứng hover cho các hàng */
        }

        .btn-warning {
            margin: 0 5px; /* Khoảng cách giữa các nút */
        }

        @media (max-width: 768px) {
            .table {
                font-size: 0.9rem; /* Giảm kích thước chữ trên thiết bị nhỏ */
            }
        }
    </style>

    <h1>Danh Sách Đơn Hàng</h1>

    <!-- Thanh tìm kiếm -->
    <form action="{{ route('orders.index') }}" method="GET" class="search-form">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo tên, email, địa chỉ hoặc số điện thoại..." value="{{ request()->get('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
        </div>
    </form>

    @if($orders->isEmpty())
        <p class="text-center">Chưa có đơn hàng nào được đặt.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Khách Hàng</th>
                    <th>Email</th>
                    <th>Địa Chỉ</th>
                    <th>Số Điện Thoại</th>
                    <th>Tổng Tiền</th>
                    <th>Trạng Thái</th>
                    <th>Ngày Đặt</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->customer_email }}</td>
                        <td>{{ $order->customer_address }}</td>
                        <td>{{ $order->customer_phone }}</td>
                        <td>{{ number_format($order->total, 0, ',', '.') }} VNĐ</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('invoice.print', $order->id) }}" class="btn btn-warning">In Hóa Đơn</a>
                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">Chỉnh Sửa Trạng Thái</a>
                        </td>
                    </tr>
                    
                @endforeach
                <div class="text-center">
        <a href="{{ route('orders.chart') }}" class="btn btn-primary">Xem Biểu Đồ</a>
    </div>
            </tbody>
        </table>
    @endif
@endsection
