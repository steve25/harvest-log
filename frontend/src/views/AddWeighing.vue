<template>
  <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Nový záznam váženia</h2>

    <form class="space-y-6" @submit.prevent="handleSubmit">
      <div>
        <label for="vehicle" class="mb-2 text-sm font-medium text-gray-700">Vozidlo</label>
        <DropdownMenu
          class="w-full"
          title="Vyber vozidlo"
          :items="vehicles"
          v-model="form.vehicle_id"
          @select-items="form.vehicle_id = $event"
        />
        <p class="mt-2 text-sm text-red-600" v-if="errors?.vehicle_id">
          {{ errors.vehicle_id[0] }}
        </p>
      </div>

      <div>
        <label for="field_crop" class="block mb-2 text-sm font-medium text-gray-700"
          >Pole / Plodina</label
        >
        <DropdownMenu
          class="w-full"
          title="Vyber pole a plodinu"
          :items="fieldCrops"
          v-model="form.field_crop_id"
          @select-items="form.field_crop_id = $event"
        />
        <p class="mt-2 text-sm text-red-600" v-if="errors?.field_crop_id">
          {{ errors.field_crop_id[0] }}
        </p>
      </div>

      <div>
        <label id="coming_weight_kg" class="block mb-2 text-sm font-medium text-gray-700"
          >Hmotnosť pri príchode (kg)</label
        >
        <input
          id="coming_weight_kg"
          type="number"
          v-model="form.coming_weight_kg"
          class="px-3 py-2 w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
        />
        <p class="mt-2 text-sm text-red-600" v-if="errors?.coming_weight_kg">
          {{ errors.coming_weight_kg[0] }}
        </p>
      </div>

      <div class="pt-4 flex justify-center space-x-8 text-center">
        <button
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
import axios from 'axios'
import DropdownMenu from '@/components/DropdownMenu.vue'

import { ref, onMounted } from 'vue'

const vehicles = ref([])
const fieldCrops = ref([])
const form = ref({})
const errors = ref([])

onMounted(() => {
  axios
    .get('http://localhost:8000/vehicles')
    .then((response) => {
      vehicles.value = response.data.vehicles
    })
    .catch((error) => {
      console.error('Error fetching vehicles:', error)
    })

  axios
    .get('http://localhost:8000/field-crops')
    .then((response) => {
      fieldCrops.value = response.data.field_crops
    })
    .catch((error) => {
      console.error('Error fetching field/crops:', error)
    })
})

const handleSubmit = async () => {
  const payload = {
    vehicle_id: form.value.vehicle_id,
    field_crop_id: form.value.field_crop_id,
    coming_weight_kg: form.value.coming_weight_kg,
    start_record_at: new Date().toISOString().slice(0, 19).replace('T', ' '),
  }

  console.log(payload)

  try {
    const response = await axios.get('http://localhost:8000/csrf-token', {
      withCredentials: true,
      headers: {
        Accept: 'application/json',
      },
    })
    const csrfToken = response.data.csrf_token

    await axios.post('http://localhost:8000/weighings', payload, {
      headers: {
        'X-CSRF-Token': csrfToken,
        'Content-Type': 'application/json',
        Accept: 'application/json',
      },
      withCredentials: true,
    })
  } catch (error) {
    errors.value = error.response?.data?.errors

    console.log(error)
  }
}
</script>
