<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderByDesc('created_at')->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $data = $request->validate([
            'role' => ['required', 'in:admin,user'],
        ]);

        if ($user->id === $request->user()->id && $data['role'] !== 'admin') {
            return back()->with('error', 'Không thể hạ quyền quản trị của chính bạn.');
        }

        $user->update($data);

        return back()->with('success', 'Cập nhật phân quyền thành công.');
    }

    public function destroy(Request $request, User $user)
    {
        if ($user->id === $request->user()->id) {
            return back()->with('error', 'Bạn không thể tự xóa tài khoản của mình.');
        }

        $user->delete();

        return back()->with('success', 'Người dùng đã được xóa.');
    }
}
