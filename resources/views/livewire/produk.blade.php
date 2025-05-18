<div>
    <div class="container">
        <div class="row my-2">
            <div class="col-12">
                <button wire:click="pilihMenu('lihat')" 
                class="btn {{ $pilihanMenu=='lihat' ? 'btn-primary' : 'btn-outline-primary' }}">
                    All Produk
                </button>
                
                @if(auth()->user()->peran == 'admin')
                <button wire:click="pilihMenu('tambah')" 
                class="btn {{ $pilihanMenu=='tambah' ? 'btn-primary' : 'btn-outline-primary' }}">
                    Add Produk
                </button>
                <button wire:click="pilihMenu('excel')" 
                class="btn {{ $pilihanMenu=='excel' ? 'btn-primary' : 'btn-outline-primary' }}">
                    Impor Produk
                </button>
                @endif
                
                <button wire:loading class="btn btn-info">
                    Loading . . .
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @if ($pilihanMenu=='lihat')
                <div class="card border-primary">
                    <div class="card-header">
                        All Produk
                    </div>

                    <div class="card-body">
                        <input type="text" wire:model.defer="search" wire:keydown.enter="cariSekarang" 
                        class="form-control" placeholder="Cari nama atau kode produk">

                        <table class="table table-bordered">
                            <thead>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                @if(auth()->user()->peran == 'admin')
                                <th>Action</th>
                                @endif
                            </thead>
                            <tbody>
                                @foreach ($semuaProduk as $produk )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $produk->kode }}</td>
                                        <td>{{ $produk->nama }}</td>
                                        <td>{{ number_format($produk->harga, 0, ',', '.') }}</td>
                                        <td>{{ $produk->stok }}</td>
                                        @if(auth()->user()->peran == 'admin')
                                        <td>
                                            <button wire:click="pilihEdit({{ $produk->id }})" 
                                            class="btn btn-sm {{ $pilihanMenu=='edit' ? 'btn-primary' : 'btn-outline-primary' }}">
                                                Edit
                                            </button>
                                            <button wire:click="pilihHapus({{ $produk->id }})" 
                                            class="btn btn-sm {{ $pilihanMenu=='hapus' ? 'btn-primary' : 'btn-outline-primary' }}">
                                                Delete
                                            </button>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $semuaProduk->links() }}
                    </div>
                </div>
                @elseif ($pilihanMenu=='tambah' && auth()->user()->peran == 'admin')
                <div class="card border-primary">
                    <div class="card-header">
                        Add produk
                    </div>
                    <div class="card-body">
                        <form wire:submit='simpan'>
                            <label>Nama</label>
                            <input type="text" class="form-control" wire:model='nama'>
                            @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>
                            <label>Kode</label>
                            <input type="text" class="form-control" wire:model='kode'>
                            @error('kode')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>
                            <label>Harga</label>
                            <input type="number" class="form-control" wire:model='harga'>
                            @error('harga')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>
                            <label>Stok</label>
                            <input type="number" class="form-control" wire:model='stok'>
                            @error('stok')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>
                            <button type="submit" class="btn btn-primary mt-2">
                                Save
                            </button>
                        </form>
                    </div>
                </div>
                @elseif ($pilihanMenu=='edit' && auth()->user()->peran == 'admin')
                <div class="card border-primary">
                    <div class="card-header">
                        Edit produk
                    </div>
                    <div class="card-body">
                        <form wire:submit='simpanEdit'>
                            <label>Nama</label>
                            <input type="text" class="form-control" wire:model='nama'>
                            @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>
                            <label>Kode</label>
                            <input type="text" class="form-control" wire:model='kode'>
                            @error('kode')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>
                            <label>Harga</label>
                            <input type="number" class="form-control" wire:model='harga'>
                            @error('harga')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>
                            <label>Stok</label>
                            <input type="number" class="form-control" wire:model='stok'>
                            @error('stok')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>
                            <button type="submit" class="btn btn-primary mt-2">
                                Save
                            </button>
                        </form>
                    </div>
                </div>
                @elseif ($pilihanMenu=='hapus' && auth()->user()->peran == 'admin')
                <div class="card border-danger">
                    <div class="card-header bg-danger text-white">
                        Delete produk
                    </div>
                    <div class="card-body">
                        r u sure want to delete this produk?
                        <p>Kode: {{ $produkTerpilih->kode }}</p>
                        <p>Nama: {{ $produkTerpilih->nama }}</p>
                        <button class="btn btn-danger" wire:click='hapus'>
                            Delete
                        </button>
                        <button class="btn btn-secondary" wire:click='batal'>
                            Cancel
                        </button>
                    </div>
                </div>
                @elseif ($pilihanMenu=='excel' && auth()->user()->peran == 'admin')
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        Impor produk
                    </div>
                    <div class="card-body">
                        <form wire:submit='imporExcel'>
                            <input type="file" class="form-control" wire:model='fileExcel'>
                            <br>
                            <button class="btn btn-secondary" type="submit"> Submit </button>
                        </form>
                        </button>
                    </div>
                </div>
                @else
                <div class="alert alert-danger">
                    Anda tidak memiliki akses untuk fitur ini
                </div>
                @endif
            </div>
        </div>
    </div>
    <div style="margin-bottom: 250px;"></div>
</div>