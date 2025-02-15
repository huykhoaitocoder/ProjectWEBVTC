<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // Thêm sản phẩm vào giỏ hàng
    public function add(Request $request)
    {
        // Kiểm tra các trường bắt buộc
        if (!$request->has(['product_id', 'product_name', 'product_image', 'product_price'])) {
            return response()->json([
                'success' => false,
                'message' => 'Thiếu thông tin sản phẩm',
            ], 400);
        }

        $cart = session()->get('cart', []);
        $product_id = $request->product_id;

        if (isset($cart[$product_id])) {
            $cart[$product_id]['quantity'] += 1;
        } else {
            $cart[$product_id] = [
                'name' => $request->product_name,
                'image' => $request->product_image,
                'price' => $request->product_price,
                'quantity' => $request->quantity ?? 1,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Sản phẩm đã được thêm vào giỏ hàng',
            'cart' => $cart
        ]);
    }
}
