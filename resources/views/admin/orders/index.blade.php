@extends('admin.layout.app')

@section('title', 'Quản lý đơn hàng')

@section('content')
    <div class="d-flex justify-between align-center" style="margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem;">
        <div>
            <h2 style="margin:0;color:#333;">Đơn hàng</h2>
            <p style="margin:0;color:#777;">Theo dõi trạng thái và chi tiết các đơn hàng của khách.</p>
        </div>
    </div>

    <div class="table-card">
        <table class="table" style="width:100%;border-collapse:collapse;">
            <thead>
                <tr>
                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>Ngày đặt</th>
                    <th>Trạng thái</th>
                    <th>Tổng tiền</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? 'Ẩn danh' }}</td>
                        <td>{{ $order->created_at?->format('d/m/Y H:i') }}</td>
                        <td>
                            <span class="badge-status {{ $order->status === 'pending' ? 'badge-pending' : 'badge-completed' }}">
                                {{ $order->status === 'pending' ? 'Pending' : 'Completed' }}
                            </span>
                        </td>
                        <td>{{ number_format($order->total_price, 0, ',', '.') }}đ</td>
                        <td style="text-align:right;">
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn-outline">Chi tiết</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding:1rem;text-align:center;">Chưa có đơn hàng nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top:1.25rem;">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
