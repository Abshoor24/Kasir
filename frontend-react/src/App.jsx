import { useState, useEffect } from 'react'
import './index.css';
import axios from 'axios';
import Navbar  from './component/navbar';
import Store from './assets/store.png';

function App() {
  const [message, setMessage] = useState('');

  const goToRegister = () => {
  window.location.href = 'http://localhost:8000/register'
}

useEffect(() => {
  axios.get('http://127.0.0.1:8000/api/greeting')
    .then(res => setMessage(res.data.message))
    .catch(err => console.error(err));
}, []);

  return (
    <>
    <Navbar />

  <div className="grid grid-cols-2 min-h-screen items-center px-52 bg-[#d2e7f6]">
  {/* KIRI: Konten utama */}
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

<div className='flex justify-end'>
<img 
        src={Store} 
        alt="Deskripsi Gambar" 
       className='w-full max-w-md shadow-[0_25px_20px_-20px_rgba(0,0,0,0.3)]'
      />
</div>


</div>

    </>
  );
}

export default App;
