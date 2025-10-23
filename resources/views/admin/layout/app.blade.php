<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Za·Ze Admin')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/pink-theme.css') }}">
</head>
<body>
    @include('admin.layout.header')
    <div class="layout-wrapper">
        @include('admin.layout.sidebar')
        <main class="admin-main">
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
        </main>
    </div>
    @include('admin.layout.footer')
    @stack('scripts')
</body>
</html>
