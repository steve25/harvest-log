import { useWeighingsStore } from '@/stores/wighingsStore'
import { reactive, ref } from 'vue'

export function useForm(initialData = {}) {
  const form = reactive({ ...initialData })
  const errors = reactive({})
  const processing = ref(false)

  const weighingsStore = useWeighingsStore()

  const clearErrors = () => {
    Object.keys(errors).forEach((key) => delete errors[key])
  }

  const submit = async (payload, mode) => {
    processing.value = true
    clearErrors()

    try {
      mode === 'add'
        ? await weighingsStore.createWeighing(payload)
        : await weighingsStore.editWeighing(payload.id, payload)
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
  const setForm = async (callback) => {
    await callback()
    Object.assign(form, weighingsStore.currentItem)
  }

  return {
    form,
    errors,
    processing,
    submit,
    clearErrors,
    setForm,
  }
}
