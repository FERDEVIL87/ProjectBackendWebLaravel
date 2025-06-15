<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container container-wide">
        <div class="header-nav">
            <h2>Manajemen Backend</h2>
            <div>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none;border:none;color:#00d4ff;cursor:pointer;padding:0;">Logout</button>
                </form>
            </div>
        </div>

        {{-- Include the navigation menu only once --}}
        <nav class="menu-nav">
            <ul>
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li> {{-- Menu to return to the dashboard --}}
                <li><a href="{{ route('banners.index') }}">Manajemen Banner</a></li>
                <li><a href="{{ route('tech-news.index') }}">Tech News</a></li>
                <li><a href="{{ route('pc-rakitans.index') }}">Paket Rakitan</a></li>
                <li><a href="{{ route('laptops.index') }}">Laptop</a></li>
                <li><a href="{{ route('console-and-handhelds.index') }}">Console & Handheld PC</a></li>
                <li><a href="{{ route('pc-parts.index') }}">PC Parts</a></li>
                <li><a href="{{ route('customer-service.index') }}">Customer Service</a></li>
                <li><a href="{{ route('checkouts.index') }}">Pesanan Masuk</a></li>
            </ul>
        </nav>

        {{-- Main content section --}}
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>