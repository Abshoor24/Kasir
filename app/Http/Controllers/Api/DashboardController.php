<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;

class DashboardController extends Controller
{
    public function info(){
        return response()->json([
            'total_produk' => Produk::count(),
            'total_transaksi' => Transaksi::count(),
            'total_user' => User::count(),
        ]);
    }
}
