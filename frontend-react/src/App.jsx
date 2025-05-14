import { useState, useEffect } from 'react'
import './index.css';
import axios from 'axios';
import Navbar  from './component/navbar';

function App() {
  const [message, setMessage] = useState('');

useEffect(() => {
  axios.get('http://127.0.0.1:8000/api/greeting')
    .then(res => setMessage(res.data.message))
    .catch(err => console.error(err));
}, []);

// const goToLogin = () => {
//   window.location.href = 'http://localhost:8000/login'
// }

// const goToRegister = () => {
//   window.location.href = 'http://localhost:8000/register'
// }

  return (
    <>
    <Navbar />

      <div className='m-auto ml-52 max-w-md mx-auto p-6'>
      <h1 className='text-red-300'>Mengelola Toko</h1>
      <h1 className='text-red-300'>Lebih Mudah</h1>
      <div class="h-2 w-1/2 bg-gray-300 rounded-full my-4"></div>
      <p className='text-xl'>Kelola stok, catat transaksi, dan pantau penjualan dari mana saja.
      Cocok untuk Warung, UMKM, dan Bisnis Retail.
      Tanpa ribet, langsung pakai!</p>
      </div>



    
    </>
    
    
    
  );
}

export default App;
