@extends('layouts.app')

@section('content')
    <style>
        /* Thêm CSS tùy chỉnh cho trang chỉnh sửa trạng thái đơn hàng */
        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px; /* Khoảng cách giữa các nhóm form */
        }

        .btn-primary {
            display: block; /* Đảm bảo nút nằm giữa */
            width: 100%; /* Nút chiếm toàn bộ chiều rộng */
            padding: 10px; /* Thêm padding cho nút */
            font-size: 1.1rem; /* Kích thước chữ lớn hơn cho nút */
            background-color: #007bff; /* Màu nền cho nút */
            border: none; /* Xóa đường viền mặc định */
            color: white; /* Màu chữ cho nút */
            border-radius: 5px; /* Bo tròn các góc */
            transition: background-color 0.3s; /* Hiệu ứng chuyển màu */
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Màu nền khi hover */
        }

        .form-control {
            padding: 10px; /* Thêm padding cho input */
            border-radius: 5px; /* Bo tròn các góc cho input */
            border: 1px solid #ced4da; /* Đường viền cho input */
        }

        .form-control:focus {
            border-color: #80bdff; /* Đường viền khi focus */
            box-shadow: 0 0 5px rgba(0, 123, 255, .25); /* Hiệu ứng shadow khi focus */
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 1.5rem; /* Giảm kích thước tiêu đề trên thiết bị nhỏ */
            }

            .btn-primary {
                font-size: 1rem; /* Giảm kích thước chữ nút trên thiết bị nhỏ */
            }
        }
    </style>

    <h1>Chỉnh Sửa Trạng Thái Đơn Hàng</h1>

    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="status">Trạng Thái Đơn Hàng</label>
            <select name="status" id="status" class="form-control">
                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang Xử Lý</option>
                <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Đã Thanh Toán</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã Hủy</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập Nhật Trạng Thái</button>
    </form>
@endsection
