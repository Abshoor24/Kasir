import { useState, useEffect } from 'react';
import './index.css';
import axios from 'axios';
import Navbar from './component/navbar';
import Store from './assets/store.png';
import { Package, CreditCard, PieChart } from 'lucide-react';

function App() {
  const [message, setMessage] = useState('');

  const goToRegister = () => {
    window.location.href = 'http://localhost:8000/register';
  };

  useEffect(() => {
    axios.get('http://127.0.0.1:8000/api/greeting')
      .then(res => setMessage(res.data.message))
      .catch(err => console.error(err));
  }, []);

  return (
    <>
      <Navbar />

      <div className="min-h-screen bg-[#d2e7f6]">
        {/* Hero Section */}
        <div className="grid grid-cols-2 min-h-screen items-center px-52">
          {/* Left: Main Content */}
          <div className="space-y-6">
            <h1 className="text-[#0F4C75] text-6xl">Mengelola Tokomu</h1>
            <h1 className="text-[#0F4C75] font-bold text-6xl">Lebih Mudah</h1>
            <div className="h-3 w-60 bg-gray-300 rounded-full"></div>
            <p className="text-xl text-gray-500">
              Kelola stok, catat transaksi, dan pantau penjualan dari mana saja. Cocok untuk Warung, UMKM, dan Bisnis Retail. Tanpa ribet, langsung pakai!
            </p>
            <div className="flex items-center mt-5 space-x-2">
              <div className="bg-gray-100 px-4 py-3 text-gray-500 rounded-xl border border-r-0 border-gray-300 max-w-md w-[300px] shadow-xl">
                Create now
              </div>
              <button
                className="bg-blue-500 text-white px-6 py-3 hover:bg-blue-600 transition-colors rounded-3xl border border-l-0 whitespace-nowrap shadow-xl"
                onClick={goToRegister}
              >
                Create
              </button>
            </div>
          </div>

          {/* Right: Hero Image */}
          <div className='flex justify-end'>
            <img 
              src={Store} 
              alt="Deskripsi Gambar" 
              className='w-full max-w-md shadow-[0_20px_20px_-20px_rgba(0,0,0,0.3)]'
            />
          </div>
        </div>

        {/* Features Section */}
        <section className="py-16 px-8 lg:px-32 bg-white">
          <div className="text-center mb-16">
            <h2 className="text-3xl md:text-4xl font-bold text-[#0F4C75] mb-4">Fitur Unggulan Kami</h2>
            <p className="text-gray-600 max-w-2xl mx-auto">Dirancang khusus untuk memudahkan pengelolaan toko Anda</p>
          </div>
          
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {/* Feature 1 */}
            <div className="bg-[#f8fafc] p-8 rounded-xl hover:shadow-lg transition-all">
              <div className="bg-[#0F4C75]/10 w-14 h-14 rounded-full flex items-center justify-center mb-6">
                <Package className="w-6 h-6 text-[#0F4C75]" />
              </div>
              <h3 className="text-xl font-bold text-[#0F4C75] mb-3">Manajemen Stok Otomatis</h3>
              <p className="text-gray-600">
                Pantau stok barangn secara real-time. Catatan stok otomatis terupdate setiap transaksi.
              </p>
            </div>
            
            {/* Feature 2 */}
            <div className="bg-[#f8fafc] p-8 rounded-xl hover:shadow-lg transition-all">
              <div className="bg-[#0F4C75]/10 w-14 h-14 rounded-full flex items-center justify-center mb-6">
                <CreditCard className="w-6 h-6 text-[#0F4C75]" />
              </div>
              <h3 className="text-xl font-bold text-[#0F4C75] mb-3">Transaksi Cepat</h3>
              <p className="text-gray-600">
                Proses penjualan hanya dalam beberapa klik dengan antarmuka kasir yang intuitif.
              </p>
            </div>
            
            {/* Feature 3 */}
            <div className="bg-[#f8fafc] p-8 rounded-xl hover:shadow-lg transition-all">
              <div className="bg-[#0F4C75]/10 w-14 h-14 rounded-full flex items-center justify-center mb-6">
                <PieChart className="w-6 h-6 text-[#0F4C75]" />
              </div>
              <h3 className="text-xl font-bold text-[#0F4C75] mb-3">Analisis Penjualan</h3>
              <p className="text-gray-600">
                Laporan penjualan harian, mingguan, dan bulanan dengan visualisasi grafis. Identifikasi produk terlaris dan tren penjualan.
              </p>
            </div>
          </div>
        </section>

        {/* CTA Section */}
        <section className="py-16 px-8 lg:px-32 bg-[#0F4C75] text-white">
          <div className="max-w-4xl mx-auto text-center">
            <h2 className="text-3xl md:text-4xl font-bold mb-6">Siap Mengubah Cara Anda Mengelola Toko?</h2>
            <p className="text-lg mb-8 opacity-90">Bergabunglah dengan ribuan UMKM yang telah merasakan kemudahan mengelola toko mereka.</p>
            <button 
              className="bg-white text-[#0F4C75] hover:bg-gray-100 px-8 py-4 rounded-full font-bold transition-all shadow-lg hover:shadow-xl"
              onClick={goToRegister}
            >
              Daftar Sekarang 
            </button>
          </div>
        </section>
      </div>
    </>
  );
}
export default App;