@extends('admin.layout.app')

@section('title', 'Chỉnh sửa bài viết')

@section('content')
    <div class="breadcrumbs">
        <a href="{{ route('admin.posts.index') }}">Bài viết</a>
        <span>/</span>
        <span>Chỉnh sửa</span>
    </div>

    <div class="card-form">
        <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="d-flex gap-3" style="flex-direction:column;">
            @csrf
            @method('PUT')

            <div>
                <label for="title">Tiêu đề</label>
                <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required>
                @error('title')
                    <small style="color:#ff4fa5;">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label for="summary">Tóm tắt</label>
                <textarea id="summary" name="summary" rows="3">{{ old('summary', $post->summary) }}</textarea>
                @error('summary')
                    <small style="color:#ff4fa5;">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label for="content">Nội dung</label>
                <textarea id="content" name="content" rows="6">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <small style="color:#ff4fa5;">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label for="image">Ảnh minh họa</label>
                @if ($post->image)
                    <div style="margin-bottom:0.75rem;">
                        <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" style="max-width:220px;border-radius:12px;">
                    </div>
                @endif
                <input type="file" id="image" name="image" accept="image/*">
                @error('image')
                    <small style="color:#ff4fa5;">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn-primary" style="border:none;border-radius:10px;padding:0.8rem 1.4rem;color:#fff;font-weight:600;cursor:pointer;">Cập nhật</button>
                <a href="{{ route('admin.posts.index') }}" class="btn-outline">Quay lại</a>
            </div>
        </form>
    </div>
@endsection
