<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        [$items, $total] = $this->buildCart($request);

        if ($items->isEmpty()) {
            return redirect()->route('home')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        return view('user.checkout', compact('items', 'total'));
    }

    public function store(Request $request)
    {
        [$items, $total] = $this->buildCart($request);

        if ($items->isEmpty()) {
            return redirect()->route('home')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        DB::transaction(function () use ($request, $items, $total) {
            $order = Order::create([
                'user_id' => $request->user()->id,
                'total_price' => $total,
                'status' => 'pending',
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['product']->price,
                ]);
            }
        });

        $request->session()->forget('cart');

        return redirect()->route('home')->with('success', 'Cảm ơn bạn đã đặt hàng! Chúng tôi sẽ liên hệ sớm nhất.');
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
