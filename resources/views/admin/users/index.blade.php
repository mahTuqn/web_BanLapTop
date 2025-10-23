@extends('admin.layout.app')

@section('title', 'Quản lý người dùng')

@section('content')
    <div class="d-flex justify-between align-center" style="margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem;">
        <div>
            <h2 style="margin:0;color:#333;">Người dùng</h2>
            <p style="margin:0;color:#777;">Quản lý thành viên, phân quyền và bảo mật hệ thống.</p>
        </div>
    </div>

    <div class="table-card">
        <table class="table" style="width:100%;border-collapse:collapse;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Quyền</th>
                    <th>Ngày tham gia</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form action="{{ route('admin.users.update-role', $user) }}" method="POST" class="d-flex gap-1" style="align-items:center;">
                                @csrf
                                @method('PATCH')
                                <select name="role" style="border-radius:10px;border:1px solid var(--gray-border);padding:0.4rem 0.6rem;">
                                    <option value="user" @selected($user->role === 'user')>User</option>
                                    <option value="admin" @selected($user->role === 'admin')>Admin</option>
                                </select>
                                <button type="submit" class="btn-outline">Lưu</button>
                            </form>
                        </td>
                        <td>{{ $user->created_at?->format('d/m/Y') }}</td>
                        <td style="text-align:right;">
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Xóa người dùng này?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-outline" style="border-color:#ff7878;color:#ff4d4f;" @disabled(auth()->id() === $user->id)>Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding:1rem;text-align:center;">Chưa có người dùng nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top:1.25rem;">
            {{ $users->links() }}
        </div>
    </div>
@endsection
