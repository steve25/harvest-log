import http from './index.js'

export const getFields = async () => {
  try {
    const response = await http.get('/fields')
    return response.data
  } catch (error) {
    console.error('Error fetching fields:', error)
  }
}
