import { getCrops } from '@/http/crops'
import { getFieldCrops } from '@/http/fieldCrops'
import { getFields } from '@/http/fields'
import { getStorages } from '@/http/storages'
import { getVehicles } from '@/http/vehicles'
import { defineStore } from 'pinia'

export const useReferenceStore = defineStore('reference', {
  state: () => ({
    vehicles: [],
    fields: [],
    crops: [],
    fieldCrops: [],
    storages: [],
    loaded: {
      vehicles: false,
      fields: false,
      crops: false,
      fieldCrops: false,
      storages: false,
    },
  }),

  actions: {
    async fetch({
      vehicles = false,
      fields = false,
      crops = false,
      fieldCrops = false,
      storages = false,
      force = false,
    } = {}) {
      const promises = []

      if ((vehicles && !this.loaded.vehicles) || force) {
        promises.push(
          getVehicles().then((res) => {
            this.vehicles = res.vehicles
            this.loaded.vehicles = true
          }),
        )
      }

      if ((fields && !this.loaded.fields) || force) {
        promises.push(
          getFields().then((res) => {
            this.fields = res.fields
            this.loaded.fields = true
          }),
        )
      }

      if ((crops && !this.loaded.crops) || force) {
        promises.push(
          getCrops().then((res) => {
            this.crops = res.crops
            this.loaded.crops = true
          }),
        )
      }

      if ((fieldCrops && !this.loaded.fieldCrops) || force) {
        promises.push(
          getFieldCrops().then((res) => {
            this.fieldCrops = res.field_crops
            this.loaded.fieldCrops = true
          }),
        )
      }

      if ((storages && !this.loaded.storages) || force) {
        promises.push(
          getStorages().then((res) => {
            this.storages = res.storages
            this.loaded.storages = true
          }),
        )
      }

      await Promise.all(promises)
    },
  },
})
