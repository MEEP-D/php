<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShirtController;
use Illuminate\Support\Facades\Route;

// Route cho danh sách sản phẩm
Route::get('/shirts', [ShirtController::class, 'index'])->name('shirts.index');

// Route cho trang tạo sản phẩm mới (chỉ dành cho admin)
Route::get('/shirts/create', [ShirtController::class, 'create'])->name('shirts.create');
Route::post('/shirts', [ShirtController::class, 'store'])->name('shirts.store');
Route::get('/shirts/{id}', [ShirtController::class, 'show'])->name('shirts.show');

// Route cho việc thêm sản phẩm vào giỏ hàng
Route::post('/shirts/{shirtId}/add', [ShirtController::class, 'add'])->name('shirts.add');
// Route cập nhật số lượng sản phẩm trong giỏ hàng
Route::post('/cart/{shirtId}/update', [ShirtController::class, 'update'])->name('cart.update');
// Route xóa sản phẩm khỏi giỏ hàng
Route::delete('/cart/{shirtId}', [ShirtController::class, 'remove'])->name('cart.remove');


Route::get('/cart', [ShirtController::class, 'cart'])->name('cart.index');
// Route cho trang thanh toán
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

// Route cho trang quản lý đơn hàng
Route::get('/orders/index', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders', [OrderController::class, 'show'])->name('orders.show');
Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
Route::get('/orders/chart', [OrderController::class, 'chart'])->name('orders.chart');


Route::get('/in-hoadon/{id}', [OrderController::class, 'printInvoice'])->name('invoice.print');

// Route mặc định cho layout chính
Route::get('/', function () {
    return redirect()->route('shirts.index');
})->name('home');
