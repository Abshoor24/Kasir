<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Support\Carbon;
use App\Models\DetilTransaksi;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $hariIni = Carbon::today();

        $jumlahProduk = Produk::count();
        $jumlahTransaksiHariIni = Transaksi::where('status', 'selesai')
        ->whereDate('created_at', $hariIni)
        ->count();
        $jumlahPendapatanHariIni = Transaksi::where('status', 'selesai')
        ->whereDate('created_at', $hariIni)
        ->sum('total');

        // Buat Grafik pendapatan 7 hari terakhir
        $penjualan7Hari = Transaksi::selectRaw('DATE(created_at) as tanggal, SUM(total) as total')
            ->where('created_at', '>=', Carbon::now()->subDays(6))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        // Produk stok sedikit
        $stokMenipis = Produk::where('stok', '<', 10)->orderBy('stok')->limit(5)->get();

        // Transaksi terakhir
        $transaksiTerakhir = Transaksi::where('status', 'selesai')
        ->latest()
        ->limit(5)
        ->get();

         $produkTerlaris = DetilTransaksi::selectRaw('produk_id, SUM(jumlah) as total_terjual')
        ->groupBy('produk_id')
        ->orderByDesc('total_terjual')
        ->with('produk') // pastikan relasi produk() ada di model DetilTransaksi
        ->limit(5)
        ->get();

        return view('admin.dashboard', compact(
            'jumlahProduk',
            'jumlahTransaksiHariIni',
            'jumlahPendapatanHariIni',
            'penjualan7Hari',
            'stokMenipis',
            'transaksiTerakhir',
            'produkTerlaris',
        ));
    }
}
