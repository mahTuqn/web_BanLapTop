<header class="admin-header">
    <div class="d-flex align-center gap-3">
        <div style="display:flex;align-items:center;gap:1rem;">
            <img src="{{ asset('images/logo.png') }}" alt="Za Ze Computer Logo" style="height: 64px; width: auto; border-radius: 9999px;">
            <div>
                <h1 style="margin:0;font-size:1.5rem;color:#333;">Bảng điều khiển quản trị</h1>
                <p style="margin:0;color:#777;font-size:0.9rem;">Quản lý sản phẩm, bài viết và đơn hàng một cách trực quan</p>
            </div>
        </div>
    </div>
    <div style="display:flex;align-items:center;gap:1rem;">
        <span style="color:#555;">👋 Xin chào, <strong>{{ auth()->user()->name }}</strong></span>
        <a href="{{ route('home') }}" class="btn-outline">Xem trang người dùng</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-primary" style="border:none;border-radius:8px;padding:0.6rem 1.2rem;color:#fff;font-weight:600;cursor:pointer;">Đăng xuất</button>
        </form>
    </div>
</header>
