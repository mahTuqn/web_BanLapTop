@extends('admin.layout.app')

@section('title', 'Chi tiết đơn hàng')

@section('content')
    <div class="breadcrumbs">
        <a href="{{ route('admin.orders.index') }}">Đơn hàng</a>
        <span>/</span>
        <span>#{{ $order->id }}</span>
    </div>

    <div class="card-form">
        <div class="d-flex gap-3" style="flex-wrap:wrap;">
            <div style="flex:1;">
                <p><strong>Mã đơn:</strong> #{{ $order->id }}</p>
                <p><strong>Khách hàng:</strong> {{ $order->user->name ?? 'Ẩn danh' }}</p>
                <p><strong>Email:</strong> {{ $order->user->email ?? '---' }}</p>
            </div>
            <div style="flex:1;">
                <p><strong>Ngày đặt:</strong> {{ $order->created_at?->format('d/m/Y H:i') }}</p>
                <p><strong>Tổng tiền:</strong> {{ number_format($order->total_price, 0, ',', '.') }}đ</p>
                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="d-flex gap-2" style="align-items:center;">
                    @csrf
                    @method('PATCH')
                    <select name="status" style="width:160px;border-radius:10px;border:1px solid var(--gray-border);padding:0.5rem 0.75rem;">
                        <option value="pending" @selected($order->status === 'pending')>Pending</option>
                        <option value="completed" @selected($order->status === 'completed')>Completed</option>
                    </select>
                    <button type="submit" class="btn-primary" style="border:none;border-radius:10px;padding:0.6rem 1.2rem;color:#fff;font-weight:600;cursor:pointer;">Cập nhật</button>
                </form>
            </div>
        </div>

        <h3 style="margin-top:2rem;">Sản phẩm</h3>
        <table class="table" style="width:100%;border-collapse:collapse;">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name ?? '---' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->unit_price, 0, ',', '.') }}đ</td>
                        <td>{{ number_format($item->unit_price * $item->quantity, 0, ',', '.') }}đ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('admin.orders.index') }}" class="btn-outline" style="margin-top:1.5rem;display:inline-block;">Quay lại</a>
    </div>
@endsection
