@extends('layouts.app') <!-- Kế thừa layout chính của bạn -->

@section('content')
<div class="container">
    <h1>Biểu Đồ Đơn Hàng</h1>
    
    <div class="row">
        <div class="col-md-4">
            <h3>Tổng Đơn Hàng: {{ $totalOrders }}</h3>
        </div>
    </div>

    <h2>Số Lượng Đơn Hàng Theo Ngày</h2>
    <canvas id="revenueChart"></canvas>

    <h2>Số Lượng Đơn Hàng Theo Tháng</h2>
    <canvas id="monthlyRevenueChart"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Biểu đồ số lượng đơn hàng theo ngày
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const labels = @json($ordersByDate->pluck('date'));
        const data = {
            labels: labels,
            datasets: [{
                label: 'Số Lượng Đơn Hàng Theo Ngày',
                data: @json($ordersByDate->pluck('total')),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };
        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };
        const revenueChart = new Chart(ctx, config);

        // Biểu đồ số lượng đơn hàng theo tháng
        const monthlyCtx = document.getElementById('monthlyRevenueChart').getContext('2d');
        const monthlyLabels = @json($ordersByMonth->pluck('month'));
        const monthlyData = {
            labels: monthlyLabels,
            datasets: [{
                label: 'Số Lượng Đơn Hàng Theo Tháng',
                data: @json($ordersByMonth->pluck('total')),
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        };
        const monthlyConfig = {
            type: 'line', // Hoặc type: 'bar', tùy thuộc vào kiểu biểu đồ bạn muốn
            data: monthlyData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };
        const monthlyRevenueChart = new Chart(monthlyCtx, monthlyConfig);
    </script>

</div>
@endsection
