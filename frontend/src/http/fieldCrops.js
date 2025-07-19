import http from './index.js'

export const getFieldCrops = async () => {
  try {
    const response = await http.get('/field-crops')
    return response.data
  } catch (error) {
    console.error('Error fetching fields / crops:', error)
  }
}
