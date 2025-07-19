import http from './index.js'

export const getVehicles = async () => {
  try {
    const response = await http.get('/vehicles')
    return response.data
  } catch (error) {
    console.error('Error fetching vehicles:', error)
  }
}
