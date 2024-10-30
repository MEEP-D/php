<?php

namespace App\Http\Controllers;

use App\Models\Order; // Nếu bạn đã tạo model Order
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Sửa lại đây
use Barryvdh\DomPDF\Facade\Pdf; // Thêm dòng này nếu bạn sử dụng thư viện PDF

class OrderController extends Controller
{
    // Hiển thị danh sách đơn hàng
    public function index(Request $request) // Thêm Request $request vào tham số
    {
        $search = $request->get('search'); // Lấy giá trị tìm kiếm từ query string

        $orders = Order::when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('customer_name', 'like', "%{$search}%")
                      ->orWhere('customer_email', 'like', "%{$search}%")
                      ->orWhere('customer_address', 'like', "%{$search}%")
                      ->orWhere('customer_phone', 'like', "%{$search}%");
            });
        })
        ->get(); // Lấy danh sách đơn hàng

        return view('orders.index', compact('orders'));
    }

    // Hiển thị thông tin chi tiết của đơn hàng
    public function show($id)
    {
        // Lấy đơn hàng theo ID và nạp mối quan hệ 'items'
        $order = Order::with('items')->find($id);
    
        // Kiểm tra xem đơn hàng có tồn tại hay không
        if (!$order) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn hàng.'); // Quay lại và thông báo lỗi
        }
    
        return view('orders.show', compact('order')); // Trả về view với đơn hàng
    }
    
    // Hiển thị trang chỉnh sửa trạng thái đơn hàng
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }

    // Cập nhật trạng thái đơn hàng
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
    }

    // In hóa đơn
    public function printInvoice($id)
    {
        // Lấy đơn hàng theo ID và nạp mối quan hệ 'items'
        $order = Order::with('items')->findOrFail($id);
        
        // Kiểm tra xem đơn hàng có tồn tại hay không
        if (!$order) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn hàng.'); // Quay lại và thông báo lỗi
        }

        // Tạo PDF với view hóa đơn
        $pdf = Pdf::loadView('invoices.invoice', compact('order'));

        // Trả về PDF
        return $pdf->stream('invoice_' . $order->id . '.pdf');
    }

    public function chart()
{
    $totalOrders = Order::count(); // Đếm tổng số đơn hàng
    
    // Lấy dữ liệu đặt hàng theo ngày
    $ordersByDate = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
                         ->groupBy('date')
                         ->orderBy('date', 'asc')
                         ->get();

    // Lấy dữ liệu đặt hàng theo tháng
    $ordersByMonth = Order::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('COUNT(*) as total'))
                          ->groupBy('month')
                          ->orderBy('month', 'asc')
                          ->get();

    return view('orders.chart', compact('ordersByDate', 'totalOrders', 'ordersByMonth'));
}


}
