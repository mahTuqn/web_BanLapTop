@extends('user.layout.app')

@section('title', 'Za·Ze Computer - Sản phẩm công nghệ')

@section('content')
    <section style="margin-bottom:2.5rem;">
        <div style="display:flex;flex-direction:column;gap:1.5rem;">
            <div style="display:flex;flex-direction:column;gap:0.5rem;">
                <h2 style="margin:0;color:#ff69b4;font-size:2rem;">Khám phá thiết bị công nghệ nổi bật</h2>
                <p style="margin:0;color:#777;">Tìm kiếm chiếc laptop, CPU hay màn hình phù hợp phong cách sáng tạo của bạn.</p>
            </div>
            <form action="{{ route('home') }}" method="GET" class="d-flex gap-2" style="flex-wrap:wrap;">
                <input type="text" name="search" value="{{ $search }}" placeholder="Nhập tên sản phẩm bạn cần tìm..."
                       style="flex:1;min-width:240px;border-radius:12px;border:1px solid var(--gray-border);padding:0.85rem 1.1rem;">
                <select name="category" style="border-radius:12px;border:1px solid var(--gray-border);padding:0.85rem 1.1rem;min-width:200px;">
                    <option value="">Tất cả danh mục</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected($categoryFilter === $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="min_price" value="{{ $minPrice }}" placeholder="Giá từ"
                       style="flex:1;min-width:120px;border-radius:12px;border:1px solid var(--gray-border);padding:0.85rem 1.1rem;">
                <input type="number" name="max_price" value="{{ $maxPrice }}" placeholder="Giá đến"
                       style="flex:1;min-width:120px;border-radius:12px;border:1px solid var(--gray-border);padding:0.85rem 1.1rem;">

                <button type="submit" class="btn-primary" style="border:none;border-radius:12px;padding:0.85rem 1.5rem;color:#fff;font-weight:600;cursor:pointer;">Tìm kiếm</button>
            </form>
        </div>
    </section>

    <section style="margin-bottom:3rem;">
        <div class="product-grid">
            @forelse ($products as $product)
                <div class="product-card">
                    <a href="{{ route('products.show', $product) }}">
                        @if ($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                        @else
                            <div style="height:180px;background:rgba(255,105,180,0.12);display:flex;align-items:center;justify-content:center;color:#ff69b4;font-weight:600;">
                                Hình ảnh đang cập nhật
                            </div>
                        @endif
                    </a>
                    <div class="info">
                        <span class="chip">{{ $product->category->name ?? 'Danh mục khác' }}</span>
                        <a href="{{ route('products.show', $product) }}" style="text-decoration:none;color:#333;">
                            <h3 style="margin:0;font-size:1.1rem;">{{ $product->name }}</h3>
                        </a>
                        <p style="margin:0;color:#777;font-size:0.9rem;">{{ \Illuminate\Support\Str::limit($product->description, 90) }}</p>
                        <div class="d-flex justify-between align-center">
                            <span class="price-tag">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                            <form action="{{ route('cart.store', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-primary" style="border:none;border-radius:10px;padding:0.55rem 1rem;color:#fff;font-weight:600;cursor:pointer;">Thêm</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p>Không tìm thấy sản phẩm nào phù hợp.</p>
            @endforelse
        </div>

        <div style="margin-top:2rem;">
            {{ $products->appends(['search' => $search, 'category' => $categoryFilter, 'min_price' => $minPrice, 'max_price' => $maxPrice])->links() }}
        </div>
    </section>

    <section>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem;">
            <h2 style="margin:0;color:#333;">Bài viết công nghệ mới nhất</h2>
            <a href="{{ route('posts.index') }}" class="btn-outline">Xem tất cả bài viết</a>
        </div>
        <div class="posts-grid">
            @foreach ($latestPosts as $post)
                <article class="post-card">
                    <a href="{{ route('posts.show', $post) }}">
                        @if ($post->image)
                            <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}">
                        @else
                            <div style="height:160px;background:rgba(255,105,180,0.12);display:flex;align-items:center;justify-content:center;color:#ff69b4;font-weight:600;">
                                Đang cập nhật ảnh
                            </div>
                        @endif
                    </a>
                    <div class="body">
                        <a href="{{ route('posts.show', $post) }}" style="text-decoration:none;color:#333;">
                            <h3 style="margin:0;font-size:1.1rem;">{{ $post->title }}</h3>
                        </a>
                        <p style="margin:0;color:#777;">{{ \Illuminate\Support\Str::limit($post->summary, 100) }}</p>
                        <a href="{{ route('posts.show', $post) }}" class="btn-outline" style="align-self:flex-start;">Đọc thêm</a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection
