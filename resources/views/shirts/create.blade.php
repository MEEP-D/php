@extends('layouts.app')

@section('content')
    <h1>Thêm Mới Mặt Hàng</h1>
    <form action="{{ route('shirts.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="manufacturer">Tên sản phẩm</label>
            <input type="text" class="form-control" id="manufacturer" name="manufacturer" required>
        </div>
        <div class="form-group">
            <label for="size">Cỡ</label>
            <input type="text" class="form-control" id="size" name="size" required>
        </div>
        <div class="form-group">
            <label for="material">Chất Liệu</label>
            <input type="text" class="form-control" id="material" name="material" required>
        </div>
        <div class="form-group">
            <label for="price">Giá (VNĐ)</label>
            <input type="number" class="form-control" id="price" name="price" required min="0">
        </div>
        <div class="form-group">
            <label for="quantity">Số Lượng</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required min="1">
        </div>

        <button type="submit" class="btn btn-success">Thêm Sản Phẩm</button>
    </form>
@endsection
