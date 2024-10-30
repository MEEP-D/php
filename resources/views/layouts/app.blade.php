<!DOCTYPE html>
<html>
<head>
    <title>D Store</title>
    <!-- Thêm vào phần <head> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('shirts.index') }}">D Store</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shirts.index') }}">Sản Phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shirts.create') }}">Tạo Sản Phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart.index') }}">Giỏ Hàng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('checkout.index') }}">Thanh Toán</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('orders.index') }}">Quản Lý Đơn Hàng</a>
                </li>
                
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    
        @yield('content')
    </div>
</body>
</html>
