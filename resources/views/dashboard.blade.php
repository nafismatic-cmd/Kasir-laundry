
@extends('layouts.app')

@section('title', 'Dashboard | LaundryOS')

@section('content')

<!-- HERO BANNER -->
<section class="hero-banner">
    <div class="hero-content">
        <span class="hero-label">Dashboard </span>

        <h1>LAUNDRY MANAGEMENT SYSTEM</h1>

        <p>
            Selamat datang di sistem informasi laundry.
            Pantau seluruh aktivitas laundry dengan mudah dan cepat.
        </p>

        <a href="{{ route('data.index', 'transaksi') }}" class="hero-button">
            Lihat Transaksi <span>→</span>
        </a>
    </div>
</section>


<!-- STATISTIK -->
<div class="stats-grid">

    <a href="{{ route('data.index', 'konsumen') }}" class="stat-card">
        <div class="stat-icon blue">♙</div>

        <div class="stat-info">
            <span>Total Konsumen</span>
            <h2>{{ $konsumen }}</h2>
        </div>

        <span class="stat-arrow">→</span>
    </a>


    <a href="{{ route('data.index', 'barang') }}" class="stat-card">
        <div class="stat-icon green">▣</div>

        <div class="stat-info">
            <span>Total Barang</span>
            <h2>{{ $barang }}</h2>
        </div>

        <span class="stat-arrow">→</span>
    </a>


    <a href="{{ route('data.index', 'supplier') }}" class="stat-card">
        <div class="stat-icon orange">♧</div>

        <div class="stat-info">
            <span>Total Supplier</span>
            <h2>{{ $supplier }}</h2>
        </div>

        <span class="stat-arrow">→</span>
    </a>


    <a href="{{ route('data.index', 'transaksi') }}" class="stat-card">
        <div class="stat-icon purple">▤</div>

        <div class="stat-info">
            <span>Total Transaksi</span>
            <h2>{{ $transaksi }}</h2>
        </div>

        <span class="stat-arrow">→</span>
    </a>

</div>


<!-- TOTAL PENDAPATAN -->
<section class="revenue-card">

    <div class="revenue-content">
        <span>TOTAL PENDAPATAN TERCATAT</span>

        <h2>
            Rp {{ number_format($pendapatan, 0, ',', '.') }}
        </h2>

        <p>Akumulasi pembayaran dari seluruh transaksi.</p>
    </div>

    <div class="revenue-decoration">Rp</div>

</section>


<!-- TRANSAKSI TERBARU -->
<section class="content-card">

    <div class="card-heading">

        <div class="card-title-group">
            <div class="table-icon">▤</div>

            <div>
                <h3>Transaksi Terbaru</h3>
                <p>Daftar transaksi laundry terbaru.</p>
            </div>
        </div>

        <a href="{{ route('data.index', 'transaksi') }}" class="btn btn-outline">
            Lihat Semua →
        </a>

    </div>


    <div class="table-wrapper">

        <table>

            <thead>
                <tr>
                    <th>Nomor Transaksi</th>
                    <th>Tanggal</th>
                    <th>Tanggal Ambil</th>
                    <th>Diskon</th>
                    <th>Pembayaran</th>
                </tr>
            </thead>

            <tbody>

                @forelse($transaksiTerbaru as $item)

                <tr>
                    <td>
                        <strong class="transaction-number">
                            #{{ $item->No_Transaksi }}
                        </strong>
                    </td>

                    <td>{{ $item->Tanggal }}</td>

                    <td>{{ $item->Tanggal_Ambil ?? '-' }}</td>

                    <td>
                        Rp {{ number_format($item->Diskon, 0, ',', '.') }}
                    </td>

                    <td>
                        <strong class="payment">
                            Rp {{ number_format($item->Jumlah_Pembayaran, 0, ',', '.') }}
                        </strong>
                    </td>
                </tr>

                @empty

                <tr>
                    <td colspan="5" class="empty-data">
                        Belum ada transaksi.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</section>

@endsection
