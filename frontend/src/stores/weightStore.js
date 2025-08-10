import { defineStore } from 'pinia'
import { getWeight } from '@/http/weight.js'

export const useWeightStore = defineStore('weight', {
  state: () => ({
    weight: null,
    loading: false,
    error: null,
    refreshTimer: null
  }),
  actions: {
    async fetchWeight() {
      this.loading = true
      this.error = null
      try {
        this.weight = await getWeight()
      } catch (e) {
        this.error = e.message || 'Failed to fetch weight'
      } finally {
        this.loading = false
      }
    },

    startAutoRefresh(interval = 1000)  {
      if (this.refreshTimer) return
      this.refreshTimer = setInterval(() => this.fetchWeight(), interval)
    },

    stopAutoRefresh() {
      if (this.refreshTimer) {
        clearInterval(this.refreshTimer)
        this.refreshTimer = null
      }
    }
  }
})
