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
    
    <!-- Custom CSS untuk dropdown -->
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

    <script>
        function disabledButton(button) {
            button.classList.add('disabled', 'opacity-50', 'cursor-not-allowed');
            button.setAttribute('disabled', 'true');
            button.removeAttribute('onclick');
        }
    </script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

        <main class="py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>