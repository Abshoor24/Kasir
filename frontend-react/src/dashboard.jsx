import { useEffect, useState } from 'react'
import axios from 'axios'

export default function Dashboard() {
  const [info, setInfo] = useState(null)

  useEffect(() => {
    axios.get('http://127.0.0.1:8000/api/info-dashboard')
      .then(res => setInfo(res.data))
      .catch(err => console.error("Error Fetch : ", err))
  }, [])

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
