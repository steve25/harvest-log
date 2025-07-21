import { defineStore } from 'pinia'

export const useConfirmStore = defineStore('confirm', {
  state: () => ({
    isOpen: false,
    message: '',
    resolve: null,
  }),

  actions: {
    confirm(message) {
      this.message = message
      this.isOpen = true

      return new Promise((resolve) => {
        this.resolve = resolve
      })
    },

    accept() {
      this.isOpen = false
      if (typeof this.resolve === 'function') {
        this.resolve(true)
        this.resolve = null
      }
    },

    cancel() {
      this.isOpen = false
      if (typeof this.resolve === 'function') {
        this.resolve(false)
        this.resolve = null
      }
    },
  },
})
