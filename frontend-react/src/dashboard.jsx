import { useEffect, useState } from 'react';
import api from './lib/axios';

function Dashboard() {
    const [data, setData] = useState(null);

    useEffect(() => {
        // CSRF token penting untuk auth berbasis cookie/session
        api.get('/sanctum/csrf-cookie').then(() => {
            api.get('/api/info-dashboard')
                .then(res => setData(res.data))
                .catch(err => console.error(err));
        });
    }, []);

    if (!data) return <p>Loading...</p>;

    return (
        <div>
            <h1>Halo, {data.user}</h1>
            <p>Total Produk: {data.total_produk}</p>
            <p>Total Transaksi: {data.total_transaksi}</p>
            <p>Total User: {data.total_user}</p>
        </div>
    );
}

export default Dashboard;
