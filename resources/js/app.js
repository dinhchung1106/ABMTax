import './bootstrap';
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();

axios.defaults.withCredentials = true;

// Add a response interceptor
axios.interceptors.response.use(
  response => response,
  error => {
    // If the error is 401 Unauthorized and the user is trying to access an admin route,
    // and the current route is not the login page, redirect to login.
    if (error.response && error.response.status === 401 && router.currentRoute.value.path.startsWith('/admin') && router.currentRoute.value.name !== 'AdminLogin') {
      // Optional: Clear local storage or other stored auth data if any
      localStorage.removeItem('token');
      localStorage.removeItem('user');
      console.error('Authentication expired or invalid. Redirecting to login.');
      router.push({ name: 'AdminLogin' });
    }
    return Promise.reject(error);
  }
);
