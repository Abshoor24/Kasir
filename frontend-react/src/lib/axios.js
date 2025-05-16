import axios from 'axios';

const api = axios.create({
    baseURL: 'http://localhost:8000', // Laravel
    withCredentials: true, // buat session/cookie
});

export default api;