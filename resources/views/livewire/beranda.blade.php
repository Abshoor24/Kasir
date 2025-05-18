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

    <div class="card p-3 mt-3 shadow-sm">
    <h4>Halo, {{ Auth::user()->name }} 👋</h4>
    <p>Selamat datang di aplikasi kasir.</p>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card bg-success text-white p-3">
                <h5>Pendapatan Hari Ini</h5>
                <h3>Rp {{ number_format($jumlahPendapatanHariIni, 0, ',', '.') }}</h3>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-info text-white p-3">
                <h5>Jumlah Transaksi Hari Ini</h5>
                <h3>{{ $jumlahTransaksiHariIni }}</h3>
            </div>
        </div>
    </div>


    <!-- Navigation Buttons -->
    <button onclick="prevSlide()" class="absolute top-1/2 left-2 -translate-y-1/2 bg-white px-3 py-1 rounded-full shadow hover:bg-gray-200">&#8592;</button>
    <button onclick="nextSlide()" class="absolute top-1/2 right-2 -translate-y-1/2 bg-white px-3 py-1 rounded-full shadow hover:bg-gray-200">&#8594;</button>

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