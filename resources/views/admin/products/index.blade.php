@extends('admin.layout.app')

@section('title', 'Quản lý sản phẩm')

@section('content')
    <div class="d-flex justify-between align-center" style="margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem;">
        <div>
            <h2 style="margin:0;color:#333;">Danh sách sản phẩm</h2>
            <p style="margin:0;color:#777;">Quản lý kho sản phẩm và cập nhật thông tin nhanh chóng.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn-primary" style="display:inline-block;padding:0.75rem 1.4rem;border-radius:10px;color:#fff;font-weight:600;">+ Thêm sản phẩm</a>
    </div>

    <div class="table-card">
        <form method="GET" class="d-flex gap-2" style="margin-bottom:1.25rem;flex-wrap:wrap;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm theo tên sản phẩm..."
                   style="flex:1;min-width:220px;padding:0.65rem 1rem;border-radius:10px;border:1px solid var(--gray-border);">
            <button type="submit" class="btn-outline">Tìm kiếm</button>
        </form>

        <table class="table" style="width:100%;border-collapse:collapse;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Giá</th>
                    <th>Ngày tạo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:0.75rem;">
                                @if($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" style="width:48px;height:48px;border-radius:10px;object-fit:cover;">
                                @endif
                                <div>
                                    <strong>{{ $product->name }}</strong>
                                </div>
                            </div>
                        </td>
                        <td><span class="chip">{{ $product->category->name ?? 'N/A' }}</span></td>
                        <td>{{ number_format($product->price, 0, ',', '.') }}đ</td>
                        <td>{{ $product->created_at?->format('d/m/Y') }}</td>
                        <td style="text-align:right;">
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn-outline">Sửa</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline-block;margin-left:0.5rem;" onsubmit="return confirm('Xóa sản phẩm này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-outline" style="border-color:#ff7878;color:#ff4d4f;">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding:1rem;text-align:center;">Chưa có sản phẩm nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top:1.25rem;">
            {{ $products->withQueryString()->links() }}
        </div>
    </div>
@endsection
