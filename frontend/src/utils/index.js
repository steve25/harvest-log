export const forrmatDateTime = (dateTime) => {
  const date = new Date(dateTime)

  const dateString = date.toLocaleDateString('sk-Sk', {
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
  })

  const timeString = date.toLocaleTimeString('sk-Sk', {
    hour: '2-digit',
    minute: '2-digit',
  })

  return `${dateString} - ${timeString}`
}
