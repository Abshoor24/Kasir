import React, { useEffect, useState } from 'react';
import { createRoot } from 'react-dom/client';
import axios from 'axios';

function Dashboard() {
  const [info, setInfo] = useState(null);
    useEffect(() => {
        axios.get('./api/info-dashboard')
        .then(res =>setInfo(res.data))
        .catch(err => console.err("Error Fetch : ", err));
    }, []);

    return (
        <div className='p-6'>
            <h1 className='text-2xl font-bold mb-4'>Dashboard</h1>
            {info ? (
                <div className='space-y-2'>
                    <p>Total Produk : {info.total_produk}</p>
                    <p>Total Transaksi : {info.total_transaksi}</p>
                    <p>Total User : {info.total_user}</p>
                </div>
            ) : (
                <p>Loading . . .</p>
            )}
        </div>
    )

}

createRoot(document.getElementById('root')).render(<Dashboard />);