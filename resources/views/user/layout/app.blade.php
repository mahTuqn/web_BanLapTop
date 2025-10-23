<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Za·Ze Computer')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/pink-theme.css') }}">
</head>
<body class="user-layout">
    <header class="user-header">
        <div class="container">
            <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:0.75rem;text-decoration:none;color:inherit;">
                <img src="{{ asset('images/logo.png') }}" alt="Za Ze Computer Logo" style="height: 64px; width: auto; border-radius: 9999px;">
                <div>
                    <strong style="font-size:1.2rem;color:#333;">Za·Ze Computer</strong>
                    <p style="margin:0;font-size:0.85rem;color:#777;">Công nghệ sắc hồng, trải nghiệm sáng tạo</p>
                </div>
            </a>
            <nav style="display:flex;align-items:center;gap:1rem;flex-wrap:wrap;">
                <a href="{{ route('home') }}" style="font-weight:600;color:{{ request()->routeIs('home') ? '#ff69b4' : '#555' }};">Sản phẩm</a>
                <a href="{{ route('posts.index') }}" style="font-weight:600;color:{{ request()->routeIs('posts.*') ? '#ff69b4' : '#555' }};">Bài viết</a>
                <a href="{{ route('cart.index') }}" style="font-weight:600;color:{{ request()->routeIs('cart.*') ? '#ff69b4' : '#555' }};">Giỏ hàng</a>
                <a href="{{ route('checkout.index') }}" style="font-weight:600;color:{{ request()->routeIs('checkout.*') ? '#ff69b4' : '#555' }};">Thanh toán</a>
            </nav>
            <div style="display:flex;align-items:center;gap:0.75rem;flex-wrap:wrap;">
                @auth
                    <span style="color:#555;">Xin chào, <strong>{{ auth()->user()->name }}</strong></span>
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn-outline">Vào admin</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-primary" style="border:none;border-radius:8px;padding:0.55rem 1.1rem;color:#fff;font-weight:600;cursor:pointer;">Đăng xuất</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-outline">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="btn-primary" style="border:none;border-radius:8px;padding:0.55rem 1.1rem;color:#fff;font-weight:600;">Đăng ký</a>
                @endauth
            </div>
        </div>
    </header>

    <main style="flex:1;padding:2.5rem 0;">
        <div class="container">
            @if (session('success'))
                <div style="background-color:rgba(46,204,113,0.12);border:1px solid rgba(46,204,113,0.3);padding:0.75rem 1rem;border-radius:10px;color:#2ecc71;margin-bottom:1.5rem;">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div style="background-color:rgba(255,105,180,0.12);border:1px solid rgba(255,105,180,0.4);padding:0.75rem 1rem;border-radius:10px;color:#ff4fa5;margin-bottom:1.5rem;">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <small>© {{ now()->year }} Za·Ze Computer. Nguồn cảm hứng từ công nghệ và sắc hồng.</small>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
