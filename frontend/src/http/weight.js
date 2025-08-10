import http from './index.js'

export const getWeight = async () => {
  try {
    const response = await http.get('/weight')
    return response.data
  } catch (error) {
    console.error('Error fetching weight:', error)
  }
}
