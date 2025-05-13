import { useState, useEffect } from 'react'
import './App.css'

function App() {
  const [message, setMessage] = useState('');

  useEffect(() => {
    fetch('http://127.0.0.1:8000/api/greeting')
      .then(res => res.json())
      .then(data => setMessage(data.message));
  }, []);

  return (
    <>
      <div>
      <h1>React Frontend</h1>
      <p>Pesan dari Laravel: {message}</p>
      </div>

       <div>
      <h1>Selamat Datang di Kasir App</h1>
      <a href="/login"><button>Login</button></a>
      <a href="/register"><button>Register</button></a>
    </div>
    </>
    
  );
}

export default App;
