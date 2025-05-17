<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetilTransaksi;
use App\Models\Produk;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class KasirDashboardController extends Controller
{
    public function index()
    {
        $hariIni = Carbon::today();

        $jumlahTransaksiHariIni = Transaksi::whereDate('created_at', $hariIni)->count();
        $jumlahPendapatanHariIni = Transaksi::whereDate('created_at', $hariIni)->sum('total');

        $transaksiHariIni = Transaksi::with('detilTransaksi')->whereDate('created_at', $hariIni)->latest()->get();

        $produkTerlaris = DetilTransaksi::select('produk_id', DB::raw('SUM(jumlah) as total_terjual'))
            ->whereHas('transaksi', function ($q) use ($hariIni) {
                $q->whereDate('created_at', $hariIni);
            })
            ->groupBy('produk_id')
            ->orderByDesc('total_terjual')
            ->with('produk')
            ->limit(5)
            ->get();

        return view('kasir.dashboard', compact(
            'jumlahTransaksiHariIni',
            'jumlahPendapatanHariIni',
            'transaksiHariIni',
            'produkTerlaris'
        ));
    }
}
