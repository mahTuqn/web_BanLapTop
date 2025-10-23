@extends('user.layout.app')

@section('title', 'Thanh toán - Za·Ze Computer')

@section('content')
    <h1 style="margin:0 0 1.5rem 0;color:#333;">Thanh toán tượng trưng</h1>

    <div class="d-flex gap-3" style="flex-wrap:wrap;">
        <div class="card-form" style="flex:1;min-width:300px;">
            <h3 style="margin-top:0;">Thông tin đơn hàng</h3>
            <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:0.75rem;">
                @foreach ($items as $item)
                    <li class="d-flex justify-between">
                        <span>{{ $item['product']->name }} × {{ $item['quantity'] }}</span>
                        <strong>{{ number_format($item['subtotal'], 0, ',', '.') }}đ</strong>
                    </li>
                @endforeach
            </ul>
            <div class="d-flex justify-between" style="margin-top:1.5rem;font-size:1.1rem;">
                <span>Tổng cộng</span>
                <strong>{{ number_format($total, 0, ',', '.') }}đ</strong>
            </div>
        </div>
        <div class="card-form" style="flex:1;min-width:300px;">
            <h3 style="margin-top:0;">Hoàn tất đặt hàng</h3>
            <p style="color:#555;">Đơn hàng của bạn sẽ được ghi nhận và đội ngũ Za·Ze sẽ liên hệ xác nhận trong thời gian sớm nhất.</p>
            <form action="{{ route('checkout.store') }}" method="POST" class="d-flex gap-2" style="flex-direction:column;">
                @csrf
                <button type="submit" class="btn-primary" style="border:none;border-radius:10px;padding:0.85rem 1.4rem;color:#fff;font-weight:600;cursor:pointer;">Xác nhận đặt hàng</button>
                <a href="{{ route('home') }}" class="btn-outline" style="text-align:center;">Quay lại mua sắm</a>
            </form>
        </div>
    </div>
@endsection
