@extends('user.layout.app')

@section('title', 'Tin tức công nghệ - Za·Ze Computer')

@section('content')
    <h1 style="margin:0 0 1.5rem 0;color:#333;">Bài viết công nghệ</h1>
    <div class="posts-grid">
        @forelse ($posts as $post)
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
                    <p style="margin:0;color:#777;">{{ Str::limit($post->summary, 120) }}</p>
                    <span style="font-size:0.85rem;color:#aaa;">{{ $post->created_at?->format('d/m/Y') }} - {{ $post->views }} lượt xem</span>
                    <a href="{{ route('posts.show', $post) }}" class="btn-outline" style="align-self:flex-start;">Đọc thêm</a>
                </div>
            </article>
        @empty
            <p>Chúng tôi sẽ cập nhật bài viết trong thời gian sớm nhất.</p>
        @endforelse
    </div>

    <div style="margin-top:2rem;">
        {{ $posts->links() }}
    </div>
@endsection
