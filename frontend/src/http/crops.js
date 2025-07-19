import http from './index.js'

export const getCrops = async () => {
  try {
    const response = await http.get('/crops')
    return response.data
  } catch (error) {
    console.error('Error fetching crops:', error)
  }
}
