<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produk as ModelProduk;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Produk as ImporProduk;

class Produk extends Component
{
    use WithFileUploads, WithPagination;
    public $pilihanMenu = 'lihat';
    public $nama;
    public $kode;
    public $harga;
    public $stok;
    public $produkTerpilih;
    public $fileExcel;
    public $search = '';

    protected $paginationTheme = 'bootstrap'; // buat bikin pagination sama bootstrap


    public function mount()
    {
       if(auth()->User()->peran !='admin'){
        abort(403);
       }
    }


    public function updatingSearch()
{
    $this->resetPage();
}

    public function cariSekarang(){
        $this->resetPage();
    }

    public function produk() {
        session()->flash('produk_visited', true);
        return view('produk');
    }

    public function imporExcel(){
        Excel::import(new ImporProduk, $this->fileExcel);
        $this->reset();
    }


    public function pilihEdit($id)
    {
        $this->produkTerpilih = ModelProduk::findOrFail($id);
        $this->nama = $this->produkTerpilih->nama;
        $this->kode = $this->produkTerpilih->kode;
        $this->harga = $this->produkTerpilih->harga;
        $this->stok = $this->produkTerpilih->stok;
        $this->pilihanMenu = 'edit';
    }


    public function simpanEdit(){
        $this->validate([
            'nama' => 'required',
            'kode' => ['required', 'unique:produks,kode,'.$this->produkTerpilih->id],
            'harga' => 'required',
            'stok' => 'required',
            
        ],[
            'nama.required' => 'Nama Harus Diisi',
            'kode.required' => 'kode Harus Diisi',
            'kode.unique' => 'kode telah digunakan',
            'harga.required' => 'harga harus diisi',
            'stok.required' => 'stok harus diisi',
        ]);
        $simpan = $this->produkTerpilih;;
        $simpan->nama = $this->nama;
        $simpan->kode = $this->kode;
        $simpan->stok = $this->stok;
        $simpan->harga = $this->harga;
        $simpan->save();

        $this->reset(['nama', 'kode', 'stok', 'harga', 'produkTerpilih']);
        $this->pilihanMenu = 'lihat';
    }

    public function pilihHapus($id)
    {
        $this->produkTerpilih = ModelProduk::findOrFail($id);
        $this->pilihanMenu = 'hapus';
    }




    public function hapus(){
        $this->produkTerpilih->delete();
        $this->reset();
    }

    public function batal() {
        $this->reset();
    }


    public function simpan(){
        $this->validate([
            'nama' => 'required',
            'kode' => ['required', 'unique:produks,kode'],
            'harga' => 'required',
            'stok' => 'required',
            
        ],[
            'nama.required' => 'Nama Harus Diisi',
            'kode.required' => 'kode Harus Diisi',
            'kode.unique' => 'kode telah digunakan',
            'harga.required' => 'harga harus diisi',
            'stok.required' => 'stok harus diisi',
        ]);
        $simpan = new ModelProduk();
        $simpan->nama = $this->nama;
        $simpan->kode = $this->kode;
        $simpan->stok = $this->stok;
        $simpan->harga = str_replace('.', '', $this->harga);
        $simpan->user_id = auth()->id(); // atau auth()->user()->id
        $simpan->save();

        $this->reset(['nama', 'kode', 'stok', 'harga', 'produkTerpilih']);
        $this->pilihanMenu = 'lihat';

    }
    public function pilihMenu($menu){
        $this->pilihanMenu = $menu;
    }

    // public function render()
    // {
    //     return view('livewire.produk')->with([
    //         'semuaProduk' => ModelProduk::where('user_id', auth()->id())->get()
    //     ]);
    // }

    public function render(){
        $semuaProduk = ModelProduk::where('user_id',  auth()->id())
        ->where(function($query){
            $query->where('nama', 'like', '%'. $this->search. '%')
                ->orwhere('kode', 'like', '%'. $this->search. '%');
        })
        ->paginate(10); // berapa halaman yg ada di table

    // return view('livewire.produk')->with([
    //     'semuaProduk' => $semuaProduk
    // ]);

    return view('livewire.produk', compact('semuaProduk'));
    }

}
