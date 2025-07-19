import { getCookie } from '@/utils'
import axios from 'axios'

const http = axios.create({
  baseURL: 'http://localhost:8000/',
  timeout: 1000,
  headers: {
    'Content-Type': 'application/json',
    Accept: 'application/json',
  },
  withCredentials: true,
})

http.interceptors.request.use(
  async (config) => {
    let csrfToken = getCookie('XSRF-TOKEN')

    if (!csrfToken || csrfToken === 'undefined') {
      try {
        const response = await axios.get('http://localhost:8000/csrf-token', {
          withCredentials: true,
          headers: {
            Accept: 'application/json',
          },
        })
        csrfToken = response.data.token
        localStorage.setItem('CSRF_TOKEN', csrfToken)
      } catch (error) {
        console.error('Failed to fetch CSRF token', error)
      }
    }

    if (csrfToken && csrfToken !== 'undefined') {
      config.headers['X-XSRF-TOKEN'] = csrfToken
    }
    return config
  },
  (error) => {
    return Promise.reject(error)
  },
)

export default http
