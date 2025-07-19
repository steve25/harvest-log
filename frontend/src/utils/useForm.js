import { reactive, ref } from 'vue'

export function useForm(initialData = {}) {
  const form = reactive({ ...initialData })
  const errors = reactive({})
  const processing = ref(false)

  const clearErrors = () => {
    Object.keys(errors).forEach((key) => delete errors[key])
  }

  const submit = async (callback) => {
    processing.value = true
    clearErrors()

    try {
      await callback()
    } catch (error) {
      if (error.response && error.response.data && error.response.data.errors) {
        Object.assign(errors, error.response.data.errors)
      } else {
        console.error('Unexpected error:', error)
      }
      throw error
    } finally {
      processing.value = false
    }
  }

  return {
    form,
    errors,
    processing,
    submit,
    clearErrors,
  }
}
