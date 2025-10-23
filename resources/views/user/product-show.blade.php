@extends('user.layout.app')

@section('title', $product->name . ' - Za·Ze Computer')

@section('content')
    <div class="breadcrumbs">
        <a href="{{ route('home') }}">Trang chủ</a>
        <span>/</span>
        <span>{{ $product->category->name ?? 'Sản phẩm' }}</span>
        <span>/</span>
        <span>{{ $product->name }}</span>
    </div>

    <div class="d-flex gap-3" style="flex-wrap:wrap;margin-bottom:2.5rem;">
        <div style="flex:1;min-width:280px;">
            @if ($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" style="width:100%;border-radius:16px;object-fit:cover;">
            @else
                <div style="height:320px;background:rgba(255,105,180,0.12);display:flex;align-items:center;justify-content:center;color:#ff69b4;font-weight:600;border-radius:16px;">
                    Hình ảnh đang cập nhật
                </div>
            @endif
        </div>
        <div style="flex:1;min-width:280px;display:flex;flex-direction:column;gap:1rem;">
            <span class="chip" style="align-self:flex-start;">{{ $product->category->name ?? 'Danh mục khác' }}</span>
            <h1 style="margin:0;color:#333;">{{ $product->name }}</h1>
            <div class="price-tag" style="font-size:1.5rem;">{{ number_format($product->price, 0, ',', '.') }}đ</div>
            <p style="color:#555;line-height:1.7;">{!! nl2br(e($product->description)) !!}</p>
            <form action="{{ route('cart.store', $product) }}" method="POST" class="d-flex gap-2" style="align-items:center;">
                @csrf
                <label for="quantity" style="font-weight:600;color:#555;">Số lượng</label>
                <input type="number" name="quantity" id="quantity" value="1" min="1"
                       style="width:80px;border-radius:10px;border:1px solid var(--gray-border);padding:0.5rem 0.75rem;">
                <button type="submit" class="btn-primary" style="border:none;border-radius:10px;padding:0.75rem 1.4rem;color:#fff;font-weight:600;cursor:pointer;">Thêm vào giỏ</button>
            </form>
        </div>
    </div>

    @if ($relatedProducts->isNotEmpty())
        <section>
            <h2 style="color:#333;">Sản phẩm cùng danh mục</h2>
            <div class="product-grid" style="margin-top:1.5rem;">
                @foreach ($relatedProducts as $related)
                    <div class="product-card">
                        <a href="{{ route('products.show', $related) }}">
                            @if ($related->image)
                                <img src="{{ asset('storage/'.$related->image) }}" alt="{{ $related->name }}">
                            @else
                                <div style="height:180px;background:rgba(255,105,180,0.12);display:flex;align-items:center;justify-content:center;color:#ff69b4;font-weight:600;">
                                    Hình ảnh đang cập nhật
                                </div>
                            @endif
                        </a>
                        <div class="info">
                            <h3 style="margin:0;font-size:1rem;">{{ $related->name }}</h3>
                            <span class="price-tag">{{ number_format($related->price, 0, ',', '.') }}đ</span>
                            <a href="{{ route('products.show', $related) }}" class="btn-outline" style="align-self:flex-start;">Xem chi tiết</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
@endsection
