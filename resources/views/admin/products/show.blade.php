@extends('admin.layout.app')

@section('title', 'Chi tiết sản phẩm')

@section('content')
    <div class="breadcrumbs">
        <a href="{{ route('admin.products.index') }}">Sản phẩm</a>
        <span>/</span>
        <span>{{ $product->name }}</span>
    </div>

    <div class="card-form">
        <div class="d-flex gap-3" style="flex-wrap:wrap;">
            <div style="flex:1;min-width:240px;">
                @if ($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" style="width:100%;border-radius:14px;object-fit:cover;">
                @else
                    <div style="background:rgba(255,105,180,0.12);border-radius:14px;height:240px;display:flex;align-items:center;justify-content:center;color:#ff69b4;">Chưa có ảnh</div>
                @endif
            </div>
            <div style="flex:2;min-width:260px;">
                <h2 style="margin-top:0;">{{ $product->name }}</h2>
                <p><strong>Danh mục:</strong> {{ $product->category->name ?? 'N/A' }}</p>
                <p><strong>Giá:</strong> {{ number_format($product->price, 0, ',', '.') }}đ</p>
                <p><strong>Mô tả:</strong></p>
                <p>{{ $product->description }}</p>

                <div class="d-flex gap-2" style="margin-top:1.5rem;">
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn-primary" style="display:inline-block;padding:0.75rem 1.4rem;border-radius:10px;color:#fff;font-weight:600;">Chỉnh sửa</a>
                    <a href="{{ route('admin.products.index') }}" class="btn-outline">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
@endsection
