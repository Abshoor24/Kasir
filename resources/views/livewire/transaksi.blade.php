<div>
    <div class="container">
        <div class="row mt-2">
            <div class="col-12">
                @if (!$transaksiAktif)
                <button class="btn btn-primary" wire:click='transaksiBaru'>Transaksi Baru</button>
                @else
                <button class="btn btn-danger" wire:click='batalTransaksi'>Batalkan Transaksi</button>
                @endif
                <button class="btn btn-info" wire:loading>Loading . . . </button>
                
            </div>
        </div>
        @if ($transaksiAktif)
        <div class="row mt-2">
            <!-- Kolom kiri (8/12) -->
            <div class="col-md-8">
                <div class="card border-primary">
                    <div class="card-body">
                        <h4 class="card-title">No Invoice : {{ $transaksiAktif->kode }}</h4>
                        <input type="text" class="form-control" placeholder="No Invoice" wire:model.live='kode'>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($semuaProduk as $produk)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $produk->produk->kode }}</td>
                                            <td>{{ $produk->produk->nama }}</td>
                                            <td>{{ number_format($produk->produk->harga, 2, '.', ',') }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <button class="btn btn-sm btn-outline-danger" 
                                                            wire:click="kurangProduk({{ $produk->id }})"
                                                            @if($produk->jumlah <= 1) disabled @endif>
                                                        -
                                                    </button>
                                                    <span class="mx-2">{{ $produk->jumlah }}</span>
                                                    <button class="btn btn-sm btn-outline-success" 
                                                            wire:click="tambahProduk({{ $produk->id }})"
                                                            @if($produk->produk->stok < 1) disabled @endif>
                                                        +
                                                    </button>
                                                </div>
                                            </td>
                                            <td>{{ number_format($produk->produk->harga * $produk->jumlah, 2, '.', ',') }}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm" 
                                                        wire:click='hapusProduk({{ $produk->id }})'>
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
            
            <!-- Kolom kanan (4/12) -->
            <div class="col-md-4">
                <!-- Grup kolom kanan -->
                <div class="card border-primary mb-4"> <!-- mb-4 untuk margin bawah -->
                    <div class="card-body">
                        <h4 class="card-title">Total Biaya</h4>
                        <div class="d-flex justify-content-between">
                            <span>Rp. </span>
                            <span>{{ number_format($totalSemuaBelanja,2,'.',',') }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Kolom tambahan di bawahnya -->
                <div class="card border-primary mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Bayar</h4>
                        <input type="number" class="form-control" placeholder="bayar" wire:model.live='bayar'>
                    </div>
                </div>

                <div class="card border-primary">
                    <div class="card-body">
                        <h4 class="card-title">Kembalian</h4>
                        <div class="d-flex justify-content-between">
                            <span>Rp. </span>
                            <span>{{ number_format($kembalian,2,'.',',') }}</span>
                        </div>
                    </div>
                </div>
                @if ($bayar)
                @if ($kembalian < 0)
                    <div class="alert alert-danger mt-2" role="alert">
                        uang kurang
                    </div>
                @elseif ($kembalian >= 0)
                    <button class="btn btn-success mt-2 w-100" wire:click='transaksiSelesai'>Bayar</button>  
                @endif              
                @endif
            </div>
        </div>
        @endif
    </div>
        <div style="margin-bottom: 200px;"></div>
</div>



