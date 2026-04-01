<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'product_id' => 'required|array|min:1',
            'product_id.*' => 'required|exists:products,id',
            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|integer|min:1'
        ], [
            'customer_name.required' => 'Họ tên khách hàng là bắt buộc',
            'product_id.required' => 'Đơn hàng không được rỗng',
            'product_id.min' => 'Vui lòng chọn ít nhất 1 sản phẩm',
            'quantity.*.min' => 'Số lượng ít nhất là 1',
        ]);

        if (count($request->product_id) !== count($request->quantity)) {
            return back()->with('error', 'Dữ liệu sản phẩm không hợp lệ!');
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'customer_name' => $request->customer_name,
                'total_price' => 0, 
                'status' => 'pending'
            ]);

            $totalPrice = 0;

            foreach ($request->product_id as $index => $prodId) {
                $qty = $request->quantity[$index];
                $product = Product::find($prodId);

                $price = $product->price;
                $totalPrice += ($price * $qty);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'price' => $price
                ]);
            }

            $order->update(['total_price' => $totalPrice]);

            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Tạo đơn hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Đã xảy ra lỗi: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Order $order)
    {
        $order->load(['orderItems.product']);
        return view('orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed'
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}
