@extends('layouts.app')

@section('content')
    <style>
        /* Thêm CSS tùy chỉnh */
        .search-form {
            margin-bottom: 20px;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .search-form input {
            border: none;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 10px;
        }

        .search-form button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
        }

        .search-form button:hover {
            background-color: #0056b3;
        }

        .card {
            transition: transform 0.2s;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .card-text {
            font-size: 0.95rem;
            color: #555;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn-info:hover {
            background-color: #138496;
            border-color: #117a8b;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        @media (max-width: 768px) {
            .card {
                margin-bottom: 20px;
            }
        }
    </style>

    <h1 class="text-center mb-4">Danh Sách Mặt Hàng</h1>

    <!-- Thanh tìm kiếm -->
    <form action="{{ route('shirts.index') }}" method="GET" class="search-form">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo tên nhà sản xuất..." value="{{ request()->get('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
        </div>
    </form>

    <div class="row">
        @foreach($shirts as $shirt)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $shirt->manufacturer }}</h5>
                        <p class="card-text">
                            <strong>Cỡ:</strong> {{ $shirt->size }}<br>
                            <strong>Chất liệu:</strong> {{ $shirt->material }}<br>
                            <strong>Giá:</strong> {{ number_format($shirt->price, 0, ',', '.') }} VNĐ<br>
                            <strong>Số lượng:</strong> {{ $shirt->quantity }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('shirts.show', $shirt->id) }}" class="btn btn-info">Xem Chi Tiết</a>
                            <form action="{{ route('shirts.add', $shirt->id) }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
