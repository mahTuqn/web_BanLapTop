@extends('user.layout.app')

@section('title', $post->title . ' - Tin công nghệ')

@section('content')
    <div class="breadcrumbs">
        <a href="{{ route('home') }}">Trang chủ</a>
        <span>/</span>
        <a href="{{ route('posts.index') }}">Bài viết</a>
        <span>/</span>
        <span>{{ $post->title }}</span>
    </div>

    <article class="card-form" style="padding:2rem;">
        <h1 style="margin-top:0;color:#333;">{{ $post->title }}</h1>
        <p style="color:#999;font-size:0.9rem;">Đăng ngày {{ $post->created_at?->format('d/m/Y H:i') }} - {{ $post->views }} lượt xem</p>

        @if ($post->image)
            <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" style="width:100%;max-height:360px;object-fit:cover;border-radius:16px;margin:1.5rem 0;">
        @endif

        <p style="font-weight:600;color:#555;">Tóm tắt</p>
        <p style="color:#555;">{{ $post->summary }}</p>

        <div style="line-height:1.8;color:#444;">{!! nl2br(e($post->content)) !!}</div>
    </article>

    <a href="{{ route('posts.index') }}" class="btn-outline" style="margin-top:1.5rem;display:inline-block;">Quay lại danh sách</a>
@endsection
