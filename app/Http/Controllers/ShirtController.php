<?php

namespace App\Http\Controllers;

use App\Models\Shirt;
use Illuminate\Http\Request;

class ShirtController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index(Request $request)
    {
        // Lấy các từ khóa tìm kiếm từ request
        $manufacturer = $request->get('manufacturer');
        $size = $request->get('size');
        $material = $request->get('material');
        $minPrice = $request->get('min_price');
        $maxPrice = $request->get('max_price');
    
        // Lọc danh sách áo theo các tiêu chí tìm kiếm
        $shirts = Shirt::when($manufacturer, function ($query, $manufacturer) {
            return $query->where('manufacturer', 'like', "%{$manufacturer}%");
        })
        ->when($size, function ($query, $size) {
            return $query->where('size', $size);
        })
        ->when($material, function ($query, $material) {
            return $query->where('material', 'like', "%{$material}%");
        })
        ->when($minPrice, function ($query, $minPrice) {
            return $query->where('price', '>=', $minPrice);
        })
        ->when($maxPrice, function ($query, $maxPrice) {
            return $query->where('price', '<=', $maxPrice);
        })
        ->get();
    
        return view('shirts.index', compact('shirts'));
    }
        // Hiển thị form thêm mới sản phẩm
    public function create()
    {
        return view('admin.shirts.create');
    }
    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }
    // Lưu sản phẩm mới
    public function store(Request $request)
    {
        $request->validate([
            'manufacturer' => 'required',
            'size' => 'required',
            'material' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
        ]);

        // Chỉ lấy các trường hợp hợp lệ
        Shirt::create($request->only(['manufacturer', 'size', 'material', 'price', 'quantity']));

        return redirect()->route('shirts.index')->with('success', 'Sản phẩm được thêm thành công.');
    }

    // Thêm sản phẩm vào giỏ hàng
    public function add(Request $request, $shirtId)
    {
        $shirt = Shirt::findOrFail($shirtId);
        $cart = session()->get('cart', []);

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng hay chưa
        if (isset($cart[$shirt->id])) {
            $cart[$shirt->id]['quantity']++;
        } else {
            $cart[$shirt->id] = [
                'name' => $shirt->manufacturer,
                'quantity' => 1,
                'price' => $shirt->price,
            ];
        }

        // Lưu giỏ hàng vào session
        session()->put('cart', $cart);
        return redirect()->route('shirts.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

    // Xử lý đặt hàng từ giỏ hàng
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('shirts.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        // Lặp qua từng sản phẩm trong giỏ hàng
        foreach ($cart as $id => $item) {
            $shirt = Shirt::findOrFail($id);

            // Kiểm tra số lượng còn lại
            if ($shirt->quantity >= $item['quantity']) {
                // Trừ số lượng
                $shirt->quantity -= $item['quantity'];
                $shirt->save();
            } else {
                return redirect()->route('shirts.index')->with('error', "Sản phẩm {$shirt->manufacturer} đã hết hàng.");
            }
        }

        // Xóa giỏ hàng
        session()->forget('cart');

        return redirect()->route('shirts.index')->with('success', 'Đặt hàng thành công!');
    }
    // Tăng số lượng sản phẩm trong giỏ hàng
public function update(Request $request, $shirtId)
{
    $cart = session()->get('cart', []);

    // Kiểm tra nếu sản phẩm có trong giỏ hàng
    if (isset($cart[$shirtId])) {
        // Cập nhật số lượng
        $cart[$shirtId]['quantity'] += $request->quantity;
        
        // Lưu lại giỏ hàng
        session()->put('cart', $cart);
        
        return redirect()->route('cart.index')->with('success', 'Số lượng sản phẩm đã được cập nhật.');
    }

    return redirect()->route('cart.index')->with('error', 'Sản phẩm không có trong giỏ hàng.');
}
// Xóa sản phẩm khỏi giỏ hàng
public function remove($shirtId)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$shirtId])) {
        unset($cart[$shirtId]);
        session()->put('cart', $cart);
    }

    return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
}
public function show($id)
{
    $shirt = Shirt::findOrFail($id);
    return view('shirts.show', compact('shirt'));
}
}
