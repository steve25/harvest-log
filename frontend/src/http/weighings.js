import http from './index.js'

export const fetchWeighingsApi = async () => {
  const response = await http.get('/weighings')
  return response.data
}

export const fetchWeighingApi = async (id) => {
  const response = await http.get(`/weighings/${id}`)
  return response.data
}

export const createWeighingApi = async (weighing) => {
  const response = await http.post('/weighings', weighing)
  return response.data
}

export const editWeighingApi = async (id, weighing) => {
  const response = await http.put(`/weighings/${id}`, weighing)
  return response.data
}

export const deleteWeighingApi = async (id) => {
  await http.delete(`/weighings/${id}`)
}
