const SALT = 'ENCRYPTED_ID:'

export const useUtils = () => {
  const dayjs = useDayjs()
  async function scrollTo(id: string) {
    const el = document.getElementById(id)
    el?.scrollIntoView({ behavior: 'smooth' })
  }
  function formatSelectedTime(time: string) {
    const splitTime = time.split(':')
    return dayjs().set('hour', Number.parseInt(splitTime[0]!))
      .set('minute', Number.parseInt(splitTime[1]!))
      .format('h:mm A')
  }
  function formatCurrency(value: string) {
    return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD', maximumSignificantDigits: 10 })
      .format(Number(value))
  }

  function truncateText(text: string, length: number, clamp: string) {
    clamp = clamp || '...'
    return text && text.length > length ? text.slice(0, length) + clamp : text
  }

  function encrypter(data: string) {
    return btoa(SALT + data)
  }

  function decrypter(data: string) {
    const decrypted = atob(data)
    return decrypted.split(':')[1]
  }

  function toTitleCase(str: string) {
    return str
      .toLowerCase()
      .split(' ')
      .map(word => word.charAt(0).toUpperCase() + word.slice(1))
      .join(' ')
  }

  return {
    scrollTo,
    formatSelectedTime,
    formatCurrency,
    truncateText,
    encrypter,
    decrypter,
    toTitleCase,
  }
}
