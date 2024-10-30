<!-- resources/views/orders/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Danh Sách Đơn Hàng</h1>
    @if($orders->isEmpty())
        <p>Chưa có đơn hàng nào được đặt.</p>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection