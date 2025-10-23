@extends('admin.layout.app')

@section('title', 'Dashboard quản trị')

@section('content')
    <div class="stat-grid">
        <div class="stat-card">
            <span>Sản phẩm</span>
            <h3>{{ $metrics['products'] }}</h3>
        </div>
        <div class="stat-card">
            <span>Bài viết</span>
            <h3>{{ $metrics['posts'] }}</h3>
        </div>
        <div class="stat-card">
            <span>Đơn hàng</span>
            <h3>{{ $metrics['orders'] }}</h3>
        </div>
        <div class="stat-card">
            <span>Đơn chờ xử lý</span>
            <h3>{{ $metrics['pending_orders'] }}</h3>
        </div>
    </div>

    <div class="d-flex gap-3" style="margin-top:2rem;flex-wrap:wrap;">
        <div class="table-card" style="flex:1;min-width:320px;">
            <div class="d-flex justify-between align-center">
                <h4>Đơn hàng gần nhất</h4>
                <a href="{{ route('admin.orders.index') }}" class="btn-outline">Xem tất cả</a>
            </div>
            <table class="table" style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr>
                        <th>Mã đơn</th>
                        <th>Khách hàng</th>
                        <th>Ngày</th>
                        <th>Trạng thái</th>
                        <th>Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentOrders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? 'Ẩn danh' }}</td>
                            <td>{{ $order->created_at?->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge-status {{ $order->status === 'pending' ? 'badge-pending' : 'badge-completed' }}">
                                    {{ $order->status === 'pending' ? 'Pending' : 'Completed' }}
                                </span>
                            </td>
                            <td>{{ number_format($order->total_price, 0, ',', '.') }}đ</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding:1rem;text-align:center;">Chưa có đơn hàng nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="table-card" style="flex:1;min-width:320px;">
            <div class="d-flex justify-between align-center">
                <h4>Sản phẩm mới</h4>
                <a href="{{ route('admin.products.index') }}" class="btn-outline">Quản lý sản phẩm</a>
            </div>
            <table class="table" style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($latestProducts as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                            <td>{{ number_format($product->price, 0, ',', '.') }}đ</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="padding:1rem;text-align:center;">Chưa có sản phẩm nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
