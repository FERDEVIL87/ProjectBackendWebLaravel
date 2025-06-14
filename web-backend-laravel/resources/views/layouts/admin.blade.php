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
                <li><a href="#">Paket Rakitan PC</a></li>
                <li><a href="#">Laptop</a></li>
                <li><a href="#">Console & Handheld PC</a></li>
                <li><a href="{{ route('pc-parts.index') }}">PC Parts</a></li>
                <li><a href="#">Customer Service</a></li>
                <li><a href="#">Checkout</a></li>
            </ul>
        </nav>

        {{-- Main content section --}}
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>