<?php

namespace App\Livewire;

use App\Models\DetilTransaksi;
use App\Models\Transaksi as ModelsTransaksi;
use Livewire\Component;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class Transaksi extends Component
{   
    public $kode, $total, $kembalian, $totalSemuaBelanja;
    public $bayar = 0;
    public $transaksiAktif;

    public function mount()
    {
        if (!$this->transaksiAktif) {
            $this->transaksiBaru();
        }
    }


    public function transaksiBaru()
    {
        $this->reset();
        $this->transaksiAktif = new ModelsTransaksi();
        $this->transaksiAktif->kode = 'INV/' . date('YmdHis');
        $this->transaksiAktif->total = 0;
        $this->transaksiAktif->status = 'pending';
        $this->transaksiAktif->save();
    }

    public function hapusProduk($id)
    {
        DB::transaction(function () use ($id) {
            $detil = DetilTransaksi::find($id);
            if ($detil) {
                $produk = Produk::find($detil->produk_id);
                if ($produk) {
                    $produk->stok += $detil->jumlah;
                    $produk->save();
                }
                $detil->delete();
            }
        });
    }

    public function transaksiSelesai()
    {
        $this->transaksiAktif->total = $this->totalSemuaBelanja;
        $this->transaksiAktif->status = 'selesai';
        $this->transaksiAktif->created_at = now();
        $this->transaksiAktif->save();
        $this->reset();
    }

    public function batalTransaksi()
    {
        DB::transaction(function () {
            if ($this->transaksiAktif) {
                $detilTransaksi = DetilTransaksi::where('transaksi_id', $this->transaksiAktif->id)->get();
                foreach ($detilTransaksi as $detil) {
                    $produk = Produk::find($detil->produk_id);
                    if ($produk) {
                        $produk->stok += $detil->jumlah;
                        $produk->save();
                    }
                    $detil->delete();
                }
                $this->transaksiAktif->delete();
            }
        });

        $this->reset();
    }

    public function updatedKode()
    {
        if (!$this->transaksiAktif || !$this->transaksiAktif->id) {
            session()->flash('error', 'Transaksi belum dimulai.');
            return;
        }

        DB::transaction(function () {
            $produk = Produk::where('kode', $this->kode)->first();

            if ($produk && $produk->stok > 0) {
                $detil = DetilTransaksi::firstOrNew([
                    'transaksi_id' => $this->transaksiAktif->id,
                    'produk_id' => $produk->id
                ]);

                if (!$detil->exists) {
                    $detil->jumlah = 0;
                }

                $detil->jumlah += 1;
                $detil->transaksi_id = $this->transaksiAktif->id;
                $detil->produk_id = $produk->id;
                $detil->save();

                $produk->stok -= 1;
                $produk->save();

                $this->reset('kode');
            }
        });
    }

    public function tambahProduk($id)
    {
        DB::transaction(function () use ($id) {
            $detil = DetilTransaksi::find($id);
            if ($detil) {
                $produk = Produk::find($detil->produk_id);
                if ($produk && $produk->stok > 0) {
                    $detil->jumlah += 1;
                    $detil->save();
                    $produk->stok -= 1;
                    $produk->save();
                }
            }
        });
    }

    public function kurangProduk($id)
    {
        DB::transaction(function () use ($id) {
            $detil = DetilTransaksi::find($id);
            if ($detil && $detil->jumlah > 1) {
                $produk = Produk::find($detil->produk_id);
                if ($produk) {
                    $detil->jumlah -= 1;
                    $detil->save();
                    $produk->stok += 1;
                    $produk->save();
                }
            }
        });
    }

    public function updatedBayar()
    {
        if ($this->bayar > 0) {
            $this->kembalian = (int) $this->bayar - (int) $this->totalSemuaBelanja;
        }
    }

    public function render()
    {   
        if ($this->transaksiAktif) {
            $semuaProduk = DetilTransaksi::where('transaksi_id', $this->transaksiAktif->id)->get();
            $this->totalSemuaBelanja = $semuaProduk->sum(function ($detil) {
                return optional($detil->produk)->harga * $detil->jumlah;
            });
        } else {
            $semuaProduk = [];
        }

        return view('livewire.transaksi')->with([
            'semuaProduk' => $semuaProduk
        ]);
    }
}
