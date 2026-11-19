<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $konsumen = DB::table('Konsumen')->count();

        $barang = DB::table('Barang')->count();

        $supplier = DB::table('Supplier')->count();

        $tarif = DB::table('Tarif')->count();

        $transaksi = DB::table('Transaksi')->count();

        $pendapatan = DB::table('Transaksi')
            ->sum('Jumlah_Pembayaran');

        $transaksiTerbaru = DB::table('Transaksi')
            ->orderBy('Tanggal', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'konsumen',
            'barang',
            'supplier',
            'tarif',
            'transaksi',
            'pendapatan',
            'transaksiTerbaru'
        ));
    }
}
