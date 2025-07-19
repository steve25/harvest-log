import http from './index.js'

export const getStorages = async () => {
  try {
    const response = await http.get('/storages')
    return response.data
  } catch (error) {
    console.error('Error fetching storages:', error)
  }
}
