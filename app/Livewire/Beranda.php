<?php

namespace App\Livewire;

use Livewire\Component;

class Beranda extends Component
{
    public function render()
    {
        $hariIni = \Carbon\Carbon::today();

        $jumlahTransaksiHariIni = \App\Models\Transaksi::where('status', 'selesai')
            ->whereDate('created_at', $hariIni)
            ->count();

        $jumlahPendapatanHariIni = \App\Models\Transaksi::where('status', 'selesai')
            ->whereDate('created_at', $hariIni)
            ->sum('total');

        return view('livewire.beranda', compact(
            'jumlahPendapatanHariIni',
            'jumlahTransaksiHariIni'
        ));
    }
}
