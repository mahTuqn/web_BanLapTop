@extends('user.layout.app')

@section('title', 'Giỏ hàng của bạn - Za·Ze Computer')

@section('content')
    <h1 style="margin:0 0 1.5rem 0;color:#333;">Giỏ hàng</h1>

    @if ($items->isEmpty())
        <div class="card-form" style="text-align:center;">
            <p>Giỏ hàng của bạn đang trống. Hãy khám phá các sản phẩm tuyệt vời!</p>
            <a href="{{ route('home') }}" class="btn-primary" style="display:inline-block;margin-top:1rem;border:none;border-radius:10px;padding:0.75rem 1.4rem;color:#fff;font-weight:600;">Tiếp tục mua sắm</a>
        </div>
    @else
        <div class="d-flex gap-3" style="flex-wrap:wrap;">
            <div style="flex:2;min-width:320px;">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Thành tiền</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>
                                    <strong>{{ $item['product']->name }}</strong>
                                </td>
                                <td>
                                    <form action="{{ route('cart.update', $item['product']) }}" method="POST" class="d-flex gap-1" style="align-items:center;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width:70px;border-radius:10px;border:1px solid var(--gray-border);padding:0.4rem 0.6rem;">
                                        <button type="submit" class="btn-outline">Cập nhật</button>
                                    </form>
                                </td>
                                <td>{{ number_format($item['product']->price, 0, ',', '.') }}đ</td>
                                <td>{{ number_format($item['subtotal'], 0, ',', '.') }}đ</td>
                                <td>
                                    <form action="{{ route('cart.destroy', $item['product']) }}" method="POST" onsubmit="return confirm('Xóa sản phẩm này khỏi giỏ hàng?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-outline" style="border-color:#ff7878;color:#ff4d4f;">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <aside class="cart-summary" style="flex:1;min-width:260px;">
                <h3 style="margin-top:0;color:#333;">Tổng kết</h3>
                <div class="d-flex justify-between" style="margin-bottom:0.75rem;">
                    <span>Tạm tính</span>
                    <strong>{{ number_format($total, 0, ',', '.') }}đ</strong>
                </div>
                <p style="color:#777;font-size:0.85rem;">Phí vận chuyển sẽ được thông báo sau. Thanh toán hiện tại mang tính tượng trưng.</p>
                <a href="{{ route('checkout.index') }}" class="btn-primary" style="display:block;text-align:center;margin-top:1.5rem;border:none;border-radius:10px;padding:0.75rem 1.4rem;color:#fff;font-weight:600;">Tiến hành thanh toán</a>
            </aside>
        </div>
    @endif
@endsection
