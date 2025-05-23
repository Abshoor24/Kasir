import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './index.css'
import App from './App.jsx'
import Dashboard from './dashboard';

createRoot(document.getElementById('root')).render(
  <StrictMode>
    <App />
    <Dashboard />
  </StrictMode>,
)
