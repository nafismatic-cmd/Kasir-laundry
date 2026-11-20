
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'LaundryOS')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="app-container">

    <header class="topbar">

        <a href="{{ route('dashboard') }}" class="brand">
            <div class="brand-icon">🧺</div>
            <span>Laundry</span>
        </a>

        <nav class="main-nav">

            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span>⌂</span> Dashboard
            </a>

            <a href="{{ route('data.index', 'konsumen') }}"
               class="{{ request()->is('data/konsumen*') ? 'active' : '' }}">
                <span>♙</span> Konsumen
            </a>

            <a href="{{ route('data.index', 'barang') }}"
               class="{{ request()->is('data/barang*') ? 'active' : '' }}">
                <span>▣</span> Barang
            </a>

            <a href="{{ route('data.index', 'supplier') }}"
               class="{{ request()->is('data/supplier*') ? 'active' : '' }}">
                <span>♧</span> Supplier
            </a>

            <a href="{{ route('data.index', 'tarif') }}"
               class="{{ request()->is('data/tarif*') ? 'active' : '' }}">
                <span>Rp</span> Tarif
            </a>

            <a href="{{ route('data.index', 'transaksi') }}"
               class="{{ request()->is('data/transaksi*') ? 'active' : '' }}">
                <span>▤</span> Transaksi
            </a>

        </nav>

        <div class="topbar-right">
            <span class="status-dot"></span>
            <span>Sistem Aktif</span>

            <div class="admin-profile">
                <div class="avatar">A</div>
                <span>Administrator</span>
            </div>
        </div>

    </header>

    <main class="main-content">

        <section class="page-content">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')

        </section>

    </main>

</div>

<script>
    function confirmDelete() {
        return confirm('Apakah kamu yakin ingin menghapus data ini?');
    }
</script>

</body>
</html>
