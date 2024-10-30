<!-- resources/views/shirts/show.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Chi Tiết Mặt Hàng</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $shirt->manufacturer }}</h5>
                    <p class="card-text">
                        Cỡ: {{ $shirt->size }}<br>
                        Chất liệu: {{ $shirt->material }}<br>
                        Giá: {{ number_format($shirt->price, 0, ',', '.') }} VNĐ<br>
                        Số lượng: {{ $shirt->quantity }}<br>
                        Mô tả: {{ $shirt->description }} 
                    </p>
                    <form action="{{ route('shirts.add', $shirt->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
