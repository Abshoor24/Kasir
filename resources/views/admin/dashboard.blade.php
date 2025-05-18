<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>KASIRKU</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .profile-dropdown {
            display: none;
            position: absolute;
            right: 0;
            margin-top: 0.5rem;
            background-color: white;
            border-radius: 0.375rem;
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            z-index: 50;
            min-width: 10rem;
            padding: 0.5rem 0;
        }
        .profile-group:hover .profile-dropdown {
            display: block;
        }
        .dropdown-item {
            display: block;
            padding: 0.5rem 1rem;
            color: #374151;
            font-size: 0.875rem;
        }
        .dropdown-item:hover {
            background-color: #f3f4f6;
            color: #111827;
        }
        .group:hover .group-hover\:visible, 
        .group:hover .group-hover\:opacity-100,
        .dropdown:hover {
            visibility: visible !important;
            opacity: 1 !important;
        }
    </style>
</head>

<body class="bg-[#d2e7f6]">
    <div id="app">
        <!-- Navbar -->
        <nav class="bg-[#d2e7f6]">
            <div class="max-w-7xl mx-auto px-10 sm:px-10 lg:px-8">
                <div class="flex justify-between h-24 items-center">
                    <!-- Logo -->
                    <div class="w-[200px] h-10 relative">
                    <img src="{{ asset('Corousel kasir/logo.png') }}" 
                        alt="2" 
                        class="absolute w-full h-full object-cover object-center">
                    </div>
                    
                    <!-- Navigation -->
                    <div class="flex items-center space-x-24">
                        <div class="flex space-x-6">
                            @if (Auth::check() && Auth::user()->peran == 'admin')
                            <a href="{{ route('admin.dashboard') }}" 
                               class="px-3 py-2 text-lg font-medium border-b-2 {{ request()->routeIs('admin.dashboard') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                Dashboard
                            </a>
                            @endif
                            @if (Auth::check() && Auth::user()->peran == 'user')
                            <a href="{{ route('kasir.dashboard') }}" class="btn {{ request()->routeIs('kasir.dashboard') ? 'btn-primary' : 'btn-outline-primary'}}">
                                Dashboard Kasir
                            </a>
                            @endif
                            <a href="{{ route('home') }}" 
                               class="px-3 py-2 text-lg font-medium border-b-2 {{ request()->routeIs('home') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                Beranda
                            </a>
                            @if (Auth::check() && Auth::user()->peran == 'admin')
                            <a href="{{ route('user') }}" 
                               class="px-3 py-2 text-lg font-medium border-b-2 {{ request()->routeIs('user') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                Pengguna
                            </a>
                            @endif
                            @if (Auth::check() && Auth::user()->peran == 'admin')
                            <a href="{{ route('produk') }}"
                               id="produkBtn"
                               target="_blank"
                               onclick="disabledButton(this)"
                               class="px-3 py-2 text-lg font-medium border-b-2 {{ request()->routeIs('produk') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} disabled:opacity-50 disabled:cursor-not-allowed"
                               @if(session('produk_visited')) disabled @endif
                               @if(request()->routeIs('produk')) disabled @endif>
                                Produk
                            </a>
                            @endif
                            <a href="{{ route('transaksi') }}"  
                               id="transaksiBtn"
                               target="_blank"
                               onclick="disabledButton(this)"
                               class="px-3 py-2 text-lg font-medium border-b-2 {{ request()->routeIs('transaksi') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} disabled:opacity-50 disabled:cursor-not-allowed"
                               @if(session('produk_visited')) disabled @endif
                               @if(request()->routeIs('transaksi')) disabled @endif>
                                Transaksi
                            </a>
                            <a href="{{ route('laporan') }}" 
                               class="px-3 py-2 text-lg font-medium border-b-2 {{ request()->routeIs('laporan') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                Laporan
                            </a>
                        </div>

                        <!-- Profile Dropdown -->
                        @auth
                        <div class="relative group ml-4">
                            <button class="flex items-center space-x-2 focus:outline-none">
                                <div class="h-8 w-8 rounded-full bg-indigo-500 flex items-center justify-center text-white font-medium">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                            </button>
                            
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 origin-top-right hover:opacity-100 hover:visible">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                        @endauth
                    </div>
                </>
            </div>
        </nav>


    <main class="py-5" style="min-height: 100vh;">
    <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="mb-4 fw-bold text-primary">Dashboard Admin</h1>

        {{-- Statistik --}}
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-3 text-center py-4 bg-white">
                    <div class="card-body">
                        <h6 class="text-muted mb-3">Total Produk</h6>
                        <h2 class="text-primary fw-bold">{{ $jumlahProduk }}</h2>
                        <i class="bi bi-box-seam fs-1 text-primary mt-3"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-3 text-center py-4 bg-white">
                    <div class="card-body">
                        <h6 class="text-muted mb-3">Transaksi Hari Ini</h6>
                        <h2 class="text-success fw-bold">{{ $jumlahTransaksiHariIni }}</h2>
                        <i class="bi bi-receipt fs-1 text-success mt-3"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-3 text-center py-4 bg-white">
                    <div class="card-body">
                        <h6 class="text-muted mb-3">Pendapatan Hari Ini</h6>
                        <h2 class="text-warning fw-bold">Rp {{ number_format($jumlahPendapatanHariIni, 0, ',', '.') }}</h2>
                        <i class="bi bi-currency-dollar fs-1 text-warning mt-3"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Produk Terlaris & Transaksi Terbaru side by side --}}
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-primary text-white fw-semibold fs-5">5 Produk Terlaris</div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @forelse($produkTerlaris as $produk)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ optional($produk->produk)->nama ?? '-' }}</span>
                                    <span class="badge bg-success rounded-pill px-3 py-2">{{ $produk->total_terjual }} terjual</span>
                                </li>
                            @empty
                                <li class="list-group-item text-center text-muted fst-italic">Belum ada data produk</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-primary text-white fw-semibold fs-5">Transaksi Terbaru</div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @forelse($transaksiTerakhir as $transaksi)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="fw-semibold">#{{ $transaksi->id }}</span> - 
                                        Rp {{ number_format($transaksi->total, 0, ',', '.') }}
                                    </div>
                                    <small class="text-muted">{{ $transaksi->created_at->format('d M H:i') }}</small>
                                </li>
                            @empty
                                <li class="list-group-item text-center text-muted fst-italic">Belum ada transaksi</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
    
    </div>
</div>
            </div>
        </main>
    </div>
</body>
</html>




