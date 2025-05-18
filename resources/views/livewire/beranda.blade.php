<div>
    <!-- Hapus shadow dari container utama jika ada -->
    <div class="relative w-full h-[300px] overflow-hidden rounded-lg" id="carousel" style="box-shadow: none !important;">
        <!-- Slides Container -->
        <div class="flex h-full transition-transform duration-500" id="carousel-slides">
            
            <!-- Welcome Slide - Pastikan tidak ada shadow -->
            <div class="min-w-full h-full bg-green-100 relative">
                <img src="{{ asset('Corousel kasir/welcome.png') }}" 
                     alt="1" 
                     class="absolute w-full h-full object-cover object-center">
            </div>
            
            <!-- Slide lainnya dengan shadow -->
            <div class="min-w-full h-full bg-green-100 relative">
                <img src="{{ asset('Corousel kasir/1.png') }}" 
                     alt="1" 
                     class="absolute w-full h-full object-cover object-center">
            </div>

            <div class="min-w-full h-full bg-green-100 relative">
                <img src="{{ asset('Corousel kasir/2.png') }}" 
                     alt="2" 
                     class="absolute w-full h-full object-cover object-center">
            </div>

            <div class="min-w-full h-full bg-yellow-100 relative">
                <img src="{{ asset('Corousel kasir/3.png') }}" 
                     alt="3" 
                     class="absolute w-full h-full object-cover object-center">
            </div>
        </div>
    </div>

    <div class="p-6 bg-[#d2e7f6] rounded-lg mt-3 w-full flex flex-col items-center">
    <h1 class="text-4xl font-bold mb-6 text-center">Halo, {{ Auth::user()->name }} 👋</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-4xl">
        <!-- Pendapatan Hari Ini -->
        <div class="bg-green-600 text-white rounded-lg p-4 shadow w-full">
            <h5 class="text-md mb-1">Pendapatan Hari Ini</h5>
            <h3 class="text-6xl font-bold">Rp {{ number_format($jumlahPendapatanHariIni, 0, ',', '.') }}</h3>
        </div>

        <!-- Jumlah Transaksi Hari Ini -->
        <div class="bg-blue-600 text-white rounded-lg p-4 shadow w-full">
            <h5 class="text-md mb-1">Jumlah Transaksi Hari Ini</h5>
            <h3 class="text-6xl font-bold">{{ $jumlahTransaksiHariIni }}</h3>
        </div>
    </div>
</div>

<div class="grid grid-cols-4 gap-4 mt-1 p-4">
    <!-- Dashboard -->
    @if (Auth::check() && Auth::user()->peran == 'admin')
    <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md hover:shadow-lg transition-all">
        <div class="p-3 bg-blue-100 rounded-full mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
        </div>
        <span class="text-sm font-medium text-gray-700">Dashboard</span>
    </a>
    @endif
    <!-- Transaksi Baru -->
    <a href="{{ route('transaksi') }}" class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md hover:shadow-lg transition-all">
        <div class="p-3 bg-green-100 rounded-full mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
        </div>
        <span class="text-sm font-medium text-gray-700">Transaksi Baru</span>
    </a>

    <!-- Kelola Produk -->
    <a href="{{ route('produk') }}" class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md hover:shadow-lg transition-all">
        <div class="p-3 bg-purple-100 rounded-full mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
        </div>
        <span class="text-sm font-medium text-gray-700">Kelola Produk</span>
    </a>

    <!-- Laporan -->
    <a href="{{ route('laporan') }}" class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md hover:shadow-lg transition-all">
        <div class="p-3 bg-yellow-100 rounded-full mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        </div>
        <span class="text-sm font-medium text-gray-700">Laporan</span>
    </a>
</div>
    

    <script>
        let currentIndex = 0;
        const slides = document.getElementById('carousel-slides');
        const totalSlides = slides.children.length;

        function updateSlidePosition() {
            slides.style.transform = `translateX(-${currentIndex * 100}%)`;
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateSlidePosition();
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            updateSlidePosition();
        }

        setInterval(nextSlide, 5000);
    </script>


</div>