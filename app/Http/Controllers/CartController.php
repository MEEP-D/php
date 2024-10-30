<?php

namespace App\Http\Controllers;

use App\Models\Shirt;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $cartItems = Cart::where('session_id', session()->getId())->get();
        return view('cart.index', compact('cartItems'));
    }

    // Thêm sản phẩm vào giỏ hàng
    public function add(Request $request, $id)
{
    $shirt = Shirt::findOrFail($id); // Hoặc Product nếu đã đổi tên
    $sessionId = session()->getId();

    // Debug để kiểm tra thông tin sản phẩm
    dd($shirt);

    $manufacturer = $shirt->manufacturer;
    $size = $shirt->size;
    $material = $shirt->material;
    $price = $shirt->price;

    $cartItem = Cart::where('session_id', $sessionId)
                    ->where('shirt_id', $shirt->id)
                    ->first();

    if ($cartItem) {
        $cartItem->quantity += 1;
        $cartItem->save();
    } else {
        Cart::create([
            'session_id' => $sessionId,
            'shirt_id' => $shirt->id,
            'quantity' => 1,
            'manufacturer' => $manufacturer,
            'size' => $size,
            'material' => $material,
            'price' => $price,
        ]);
    }

    return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
}

    // Cập nhật giỏ hàng
    public function update(Request $request, $id)
    {
        $sessionId = session()->getId(); // Lấy session_id hiện tại

        if($request->quantity <= 0){
            return $this->remove($id);
        }

        // Tìm sản phẩm trong giỏ hàng của session hiện tại
        $cartItem = Cart::where('session_id', $sessionId)->where('shirt_id', $id)->first();

        if($cartItem) {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
            return redirect()->back()->with('success', 'Giỏ hàng đã được cập nhật.');
        }

        return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function remove($id)
    {
        $sessionId = session()->getId(); // Lấy session_id hiện tại

        // Tìm sản phẩm trong giỏ hàng của session hiện tại
        $cartItem = Cart::where('session_id', $sessionId)->where('shirt_id', $id)->first();

        if($cartItem) {
            $cartItem->delete(); // Xóa sản phẩm khỏi CSDL
            return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
        }

        return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
    }
}
