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

export const getCookie = (name) => {
  return decodeURIComponent(
    document.cookie
      .split('; ')
      .find((row) => row.startsWith(name + '='))
      ?.split('=')[1] || '',
  )
}

export const nowForDb = () => {
  const now = new Date()
  const offset = now.getTimezoneOffset() * 60000
  return new Date(now.getTime() - offset).toISOString().slice(0, 19).replace('T', ' ')
}
