@extends('admin.layout.app')

@section('title', 'Quản lý bài viết')

@section('content')
    <div class="d-flex justify-between align-center" style="margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem;">
        <div>
            <h2 style="margin:0;color:#333;">Danh sách bài viết</h2>
            <p style="margin:0;color:#777;">Cập nhật tin tức công nghệ mới nhất cho khách hàng.</p>
        </div>
        <a href="{{ route('admin.posts.create') }}" class="btn-primary" style="display:inline-block;padding:0.75rem 1.4rem;border-radius:10px;color:#fff;font-weight:600;">+ Thêm bài viết</a>
    </div>

    <div class="table-card">
        <table class="table" style="width:100%;border-collapse:collapse;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tiêu đề</th>
                    <th>Ngày tạo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:0.75rem;">
                                @if($post->image)
                                    <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" style="width:56px;height:56px;border-radius:10px;object-fit:cover;">
                                @endif
                                <div>
                                    <strong>{{ $post->title }}</strong>
                                    <p style="margin:0;color:#999;font-size:0.85rem;">{{ \Illuminate\Support\Str::limit($post->summary, 80) }}</p>
                                </div>
                            </div>
                        </td>
                        <td>{{ $post->created_at?->format('d/m/Y') }}</td>
                        <td style="text-align:right;">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn-outline">Sửa</a>
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" style="display:inline-block;margin-left:0.5rem;" onsubmit="return confirm('Xóa bài viết này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-outline" style="border-color:#ff7878;color:#ff4d4f;">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding:1rem;text-align:center;">Chưa có bài viết nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top:1.25rem;">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
