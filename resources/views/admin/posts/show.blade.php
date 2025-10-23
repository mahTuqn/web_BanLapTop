@extends('admin.layout.app')

@section('title', 'Chi tiết bài viết')

@section('content')
    <div class="breadcrumbs">
        <a href="{{ route('admin.posts.index') }}">Bài viết</a>
        <span>/</span>
        <span>{{ $post->title }}</span>
    </div>

    <div class="card-form">
        <h2 style="margin-top:0;">{{ $post->title }}</h2>
        <p style="color:#999;font-size:0.9rem;">Đăng ngày {{ $post->created_at?->format('d/m/Y H:i') }}</p>

        @if ($post->image)
            <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" style="width:100%;max-height:360px;object-fit:cover;border-radius:16px;margin:1rem 0;">
        @endif

        <p style="font-weight:600;">Tóm tắt</p>
        <p>{{ $post->summary }}</p>

        <p style="font-weight:600;">Nội dung</p>
        <div style="line-height:1.7;color:#555;">{!! nl2br(e($post->content)) !!}</div>

        <div class="d-flex gap-2" style="margin-top:1.5rem;">
            <a href="{{ route('admin.posts.edit', $post) }}" class="btn-primary" style="display:inline-block;padding:0.75rem 1.4rem;border-radius:10px;color:#fff;font-weight:600;">Chỉnh sửa</a>
            <a href="{{ route('admin.posts.index') }}" class="btn-outline">Quay lại</a>
        </div>
    </div>
@endsection
