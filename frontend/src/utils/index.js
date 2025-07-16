export const formatDate = (dateTime) => {
  const date = new Date(dateTime)

  return date.toLocaleDateString('sk-SK', {
    year: '2-digit',
    month: '2-digit',
    day: '2-digit',
  })
}

export const formatTime = (dateTime) => {
  const date = new Date(dateTime)

  return date.toLocaleTimeString('sk-SK', {
    hour: '2-digit',
    minute: '2-digit',
  })
}
