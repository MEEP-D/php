@extends('layouts.app')

@section('content')
    <h1>Danh Sách Áo Sơ Mi</h1>

    <!-- Hiển thị thông báo thành công hoặc thất bại -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        @foreach($shirts as $shirt)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $shirt->manufacturer }}</h5>
                        <p class="card-text">
                            Cỡ: {{ $shirt->size }}<br>
                            Chất liệu: {{ $shirt->material }}<br>
                            Giá: {{ number_format($shirt->price, 0, ',', '.') }} VNĐ<br>
                            Số lượng: {{ $shirt->quantity }} 
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
