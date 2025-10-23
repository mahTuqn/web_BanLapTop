<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CartController extends Controller
{
    public function index(Request $request)
    {
        [$items, $total] = $this->buildCart($request);

        return view('user.cart', compact('items', 'total'));
    }

    public function store(Request $request, Product $product)
    {
        $quantity = max((int) $request->input('quantity', 1), 1);
        $cart = $request->session()->get('cart', []);

        $cart[$product->id] = ($cart[$product->id] ?? 0) + $quantity;

        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Đã thêm sản phẩm vào giỏ hàng.');
    }

    public function update(Request $request, Product $product)
    {
        $quantity = max((int) $request->input('quantity', 1), 1);
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id] = $quantity;
            $request->session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Giỏ hàng đã được cập nhật.');
    }

    public function destroy(Request $request, Product $product)
    {
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            $request->session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }

    /**
     * @return array{Collection<int, array<string, mixed>>, float}
     */
    private function buildCart(Request $request): array
    {
        $cart = $request->session()->get('cart', []);
        $ids = array_keys($cart);

        $products = Product::whereIn('id', $ids)->get()->keyBy('id');

        $items = collect($cart)->map(function ($quantity, $productId) use ($products) {
            $product = $products->get($productId);
            if (!$product) {
                return null;
            }

            $subtotal = $product->price * $quantity;

            return [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ];
        })->filter();

        $total = $items->sum('subtotal');

        return [$items, $total];
    }
}
