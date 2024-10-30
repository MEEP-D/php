@extends('layouts.app')

@section('content')
    <style>
        /* Thêm CSS tùy chỉnh cho trang thanh toán */
        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem;
            color: #333;
        }

        .checkout-form {
            max-width: 600px; /* Giới hạn chiều rộng tối đa của form */
            margin: 0 auto; /* Căn giữa form */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }

        .form-group {
            margin-bottom: 20px; /* Tạo khoảng cách giữa các nhóm */
        }

        .form-group label {
            font-weight: bold; /* Làm đậm nhãn */
            color: #555;
        }

        .form-control {
            border-radius: 5px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc; /* Viền cho input */
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #007bff; /* Đổi màu viền khi focus */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Hiệu ứng bóng khi focus */
        }

        .btn-primary {
            background-color: #007bff; /* Màu nền cho nút */
            border-color: #007bff;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Màu nền khi hover */
            border-color: #004085; /* Màu viền khi hover */
        }

        @media (max-width: 768px) {
            .checkout-form {
                width: 100%; /* Đảm bảo form đầy đủ chiều rộng trên thiết bị nhỏ */
            }
        }
    </style>

    <div class="checkout-form">
        <h1>Thanh Toán</h1>
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="customer_name">Tên Khách Hàng</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
            </div>
            <div class="form-group">
                <label for="customer_email">Email</label>
                <input type="email" class="form-control" id="customer_email" name="customer_email" required>
            </div>
            <div class="form-group">
                <label for="customer_address">Địa Chỉ</label>
                <input type="text" class="form-control" id="customer_address" name="customer_address" required>
            </div>
            <div class="form-group">
                <label for="customer_phone">Số Điện Thoại</label>
                <input type="text" class="form-control" id="customer_phone" name="customer_phone" required>
            </div>
            <button type="submit" class="btn btn-primary">Đặt Hàng</button>
        </form>
    </div>
@endsection
