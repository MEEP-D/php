<?php

namespace App\Http\Controllers;

use App\Models\Order;   
use App\Models\OrderItem;
use App\Models\Shirt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // Hiển thị trang thanh toán
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shirts.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }
        return view('checkout.index', compact('cart'));
    }

    // Xử lý đặt hàng
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'customer_address' => 'required',
            'customer_phone' => 'required',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shirts.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        DB::beginTransaction();
        try {
            // Tính tổng tiền
            $total = collect($cart)->sum(function ($item) {
                return $item['price'] * $item['quantity'];
            });

            // Tạo đơn hàng
            $order = Order::create([
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_address' => $request->customer_address,
                'customer_phone' => $request->customer_phone,
                'total' => $total,
            ]);

            // Tạo các mục đơn hàng và cập nhật số lượng sản phẩm
            foreach ($cart as $id => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'shirt_id' => $id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                // Cập nhật số lượng sản phẩm trong cơ sở dữ liệu
                $shirt = Shirt::find($id);
                if ($shirt) {
                    $shirt->quantity -= $item['quantity'];
                    $shirt->save();
                }
            }

            DB::commit();
            session()->forget('cart');
            return redirect()->route('shirts.index')->with('success', 'Đặt hàng thành công.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi đặt hàng.');
        }
    }
}
