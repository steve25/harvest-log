<template>
  <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Nový záznam váženia</h2>

    <form class="space-y-6" @submit.prevent="handleSubmit">
      <FormField id="vehicle" label="Vozidlo" :errors="fieldError('vehicle_id')">
        <DropdownMenu
          id="vehicle"
          class="w-full"
          title="Vyber vozidlo"
          :items="reference.vehicles ?? []"
          v-model="form.vehicle_id"
        />
      </FormField>

      <FormField id="field-crop" label="Pole / Plodina" :errors="fieldError('field_crop_id')">
        <DropdownMenu
          id="field_crop"
          class="w-full"
          title="Vyber pole a plodinu"
          :items="reference.fieldCrops ?? []"
          v-model="form.field_crop_id"
        />
      </FormField>

      <div class="grid grid-cols-3 gap-10">
        <FormField
          id="coming_weight_kg"
          label="Hmotnosť pri príchode (kg)"
          :errors="fieldError('coming_weight_kg')"
        >
          <input
            id="coming_weight_kg"
            type="number"
            v-model.number="form.coming_weight_kg"
            class="px-3 py-2 w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
          />
        </FormField>
        <FormField
          id="leaving_weight_kg"
          label="Hmotnosť pri odchode (kg)"
          :errors="fieldError('leaving_weight_kg')"
        >
          <input
            id="leaving_weight_kg"
            type="number"
            v-model.number="form.leaving_weight_kg"
            :disabled="isComingWeight"
            :class="{ 'bg-gray-100 cursor-not-allowed': isComingWeight }"
            class="px-3 py-2 w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
          />
        </FormField>
        <FormField
          id="netto_weight_kg"
          label="Netto hmotnosť (kg)"
          :errors="fieldError('netto_weight_kg')"
        >
          <input
            id="netto_weight_kg"
            type="number"
            readonly
            :value="nettoWeight"
            class="px-3 py-2 w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
          />
        </FormField>
      </div>

      <div class="grid grid-cols-2 gap-10">
        <FormField
          id="bulk_density"
          label="Objemova hmotnost (kg/m³)"
          :errors="fieldError('bulk_density')"
        >
          <input
            id="bulk_density"
            type="number"
            v-model.number="form.bulk_density"
            class="px-3 py-2 w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
          />
        </FormField>
        <FormField id="moisture" label="Vlhkost" :errors="fieldError('moisture')">
          <input
            id="moisture"
            type="number"
            v-model.number="form.moisture"
            class="px-3 py-2 w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
          />
        </FormField>
      </div>

      <FormField id="storage" label="Kam odoslane" :errors="fieldError('storage_id')">
        <DropdownMenu
          id="storage"
          class="w-full"
          title="Vyber sklad"
          :items="reference.storages"
          v-model="form.storage_id"
        />
      </FormField>

      <div class="pt-4 flex justify-center space-x-8 text-center">
        <button
          :disabled="processing"
          type="submit"
          class="basis-2/3 cursor-pointer bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg transition"
        >
          Uložiť záznam
        </button>
        <RouterLink
          to="/"
          class="basis-1/3 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg transition"
        >
          Zrus
        </RouterLink>
      </div>
    </form>
  </div>
</template>

<script setup>
import DropdownMenu from '@/components/Form/DropdownMenu.vue'
import FormField from '@/components/Form/FormField.vue'

import { computed, onMounted } from 'vue'
import { createWeighing } from '@/http/weighings'
import { useForm } from '@/utils/useForm'
import { useReferenceStore } from '@/stores/referenceStore'
import { nowForDb } from '@/utils'

const { form, errors, processing, submit } = useForm({
  vehicle_id: null,
  field_crop_id: null,
  coming_weight_kg: null,
  leaving_weight_kg: null,
  bulk_density: null,
  moisture: null,
  storage_id: null,
})

const reference = useReferenceStore()

const loadReferenceData = async () => {
  await reference.fetch({ vehicles: true, fieldCrops: true, storages: true })
}

onMounted(loadReferenceData)

const nettoWeight = computed(() => {
  const { coming_weight_kg, leaving_weight_kg } = form

  return Math.abs(coming_weight_kg - leaving_weight_kg)
})

const isComingWeight = computed(() => !form.coming_weight_kg)

const hasLeft = computed(() => form.leaving_weight_kg)

const fieldError = (key) => errors?.[key] ?? []

const handleSubmit = async () => {
  const timestamp = nowForDb()
  const payload = {
    ...form,
    netto_weight_kg: nettoWeight.value,
    start_record_at: timestamp,
    recorded_at: hasLeft.value ? timestamp : null,
  }

  await submit(() => createWeighing(payload))
}
</script>
