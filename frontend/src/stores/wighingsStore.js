import {
  fetchWeighingsApi,
  deleteWeighingApi,
  createWeighingApi,
  fetchWeighingApi,
  editWeighingApi,
} from '@/http/weighings'
import { defineStore } from 'pinia'

export const useWeighingsStore = defineStore('weighings', {
  state: () => ({
    weighings: [],
    currentItem: null,
    loading: false,
    error: null,
  }),
  actions: {
    async fetchWeighings() {
      this.loading = true
      this.error = null
      try {
        this.weighings = await fetchWeighingsApi()
      } catch (e) {
        this.error = e.message || 'Failed to fetch weighings'
      } finally {
        this.loading = false
      }
    },

    async fetchWeighing(id) {
      this.loading = true
      this.error = null
      try {
        this.currentItem = await fetchWeighingApi(id)
      } catch (e) {
        this.error = e.message || 'Failed to create weighing'
      } finally {
        this.loading = false
      }
    },

    async createWeighing(weighing) {
      this.loading = true
      this.error = null
      try {
        await createWeighingApi(weighing)
      } catch (e) {
        this.error = e.message || 'Failed to create weighing'
        throw e
      } finally {
        this.loading = false
      }
    },

    async editWeighing(id, weighing) {
      this.loading = true
      this.error = null
      try {
        await editWeighingApi(id, weighing)
      } catch (e) {
        this.error = e?.message || 'Failed to edit weighing'
        throw e
      } finally {
        this.loading = false
      }
    },

    async deleteWeighing(id) {
      this.loading = true
      this.error = null
      try {
        await deleteWeighingApi(id)
        await this.fetchWeighings()
      } catch (e) {
        this.error = e.message || 'Failed to delete weighing'
      } finally {
        this.loading = false
      }
    },
  },
})
