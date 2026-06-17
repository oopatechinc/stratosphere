
export const useValidationRules = () => {

  const emailRequiredRules = (errorMessage: string) => [
    (value: string) => {
      if (value) return true
      return errorMessage
    },
  ]

  const validEmailRequiredRules = (errorMessage: string) => [
    (value: string) => {
      if (/.+@.+\..+/.test(value)) return true

      return errorMessage
    },
  ]

  const loginPasswordRules = (errorMessage: string) => [
    (value: string) => {
      if (value) return true
      return errorMessage
    }
  ]

  const registrationPasswordRules = (errorMessage: string) => [
    (value: string) => {
      if (value?.length >= 8) return true
      return errorMessage
    },
  ]

  const genericRequiredRule = (errorMessage: string) => [
    (value: string) => {
      if (Array.isArray(value) && value.length === 0) return errorMessage
      if (!value) return errorMessage

      return true
    }
  ]


  return {
    emailRequiredRules,
    validEmailRequiredRules,
    loginPasswordRules,
    registrationPasswordRules,
    genericRequiredRule
  }
}
