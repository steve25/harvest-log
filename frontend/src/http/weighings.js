import http from './index.js'

export const getWeighings = async () => {
  try {
    const response = await http.get('/weighings')
    return response.data
  } catch (error) {
    console.error('Error fetching weighings:', error)
  }
}

export const createWeighing = async (weighing) => {
  try {
    await http.post('/weighings', weighing)
  } catch (error) {
    console.error('Error store weighing:', error)
    throw error
  }
}
