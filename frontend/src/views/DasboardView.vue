<template>
  <!-- Main Container -->
  <div class="max-w-6xl mx-auto bg-white shadow rounded-2xl p-6">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Posledne vazenia</h1>
      <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Nove vazenie
      </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-4">
      <DateFilter @select-date="onSelectDateFrom" />
      <DateFilter @select-date="onSelectDateTo" />
      <SelectDropdown title="Vozidla" :items="vehicles" @select-items="onUpdateSelectedVehicles" />
      <DropdownMenu title="Polia" :items="fields" @select-items="onUpdateSelectedField" />
      <DropdownMenu title="Plodiny" :items="crops" @select-items="onUpdateSelectedCrop" />

      <!-- <button class="bg-gray-200 rounded px-3 py-2">Filter</button> -->
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left border-t border-b">
        <thead>
          <tr class="bg-gray-50">
            <th class="py-2 px-3">Vozidlo</th>
            <th class="py-2 px-3">Pole</th>
            <th class="py-2 px-3">Plodina</th>
            <th class="py-2 px-3">Vaha</th>
            <th class="py-2 px-3">Datum</th>
          </tr>
        </thead>
        <tbody class="divide-y">
          <tr v-for="weighing in filteredWeighings" :key="weighing.id">
            <td class="py-2 px-3" :title="weighing.vehicle.name">
              {{ weighing.vehicle.plate_number }}
            </td>
            <td class="py-2 px-3">{{ weighing.field_crop.field.name }}</td>
            <td class="py-2 px-3">{{ weighing.field_crop.crop.name }}</td>
            <td class="py-2 px-3">{{ weighing.netto_kg }} kg</td>
            <td class="py-2 px-3">{{ forrmatDateTime(weighing.recorded_at) }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-6 text-center">
      <div class="bg-gray-50 p-4 rounded shadow-sm">
        <p class="text-2xl font-bold">128</p>
        <p class="text-sm text-gray-600">Total Weighings</p>
      </div>
      <div class="bg-gray-50 p-4 rounded shadow-sm">
        <p class="text-2xl font-bold">1,532,870</p>
        <p class="text-sm text-gray-600">Total Weight</p>
      </div>
      <div class="bg-gray-50 p-4 rounded shadow-sm">
        <p class="text-2xl font-bold">12</p>
        <p class="text-sm text-gray-600">Vehicles</p>
      </div>
      <div class="bg-gray-50 p-4 rounded shadow-sm">
        <p class="text-2xl font-bold">8</p>
        <p class="text-sm text-gray-600">Fields</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import axios from 'axios'
import { forrmatDateTime } from '@/utils'

import { ref, onMounted, computed } from 'vue'

import DateFilter from '@/components/DateFilter.vue'
import SelectDropdown from '@/components/SelectDropdown.vue'
import DropdownMenu from '@/components/DropdownMenu.vue'

const weighings = ref([])
const vehicles = ref([])
const fields = ref([])
const crops = ref([])

const dateFrom = ref('')
const dateTo = ref('')
const selectedVehicles = ref([])
const selectedField = ref('')
const selectedCrop = ref('')

onMounted(() => {
  axios
    .get('http://localhost:8000/weighings')
    .then((response) => {
      weighings.value = response.data.weighings
    })
    .catch((error) => {
      console.error('Error fetching weighings:', error)
    })

  axios
    .get('http://localhost:8000/vehicles')
    .then((response) => {
      vehicles.value = response.data.vehicles
    })
    .catch((error) => {
      console.error('Error fetching vehicles:', error)
    })

  axios
    .get('http://localhost:8000/fields')
    .then((response) => {
      fields.value = response.data.fields
    })
    .catch((error) => {
      console.error('Error fetching fields:', error)
    })

  axios
    .get('http://localhost:8000/crops')
    .then((response) => {
      crops.value = response.data.crops
    })
    .catch((error) => {
      console.error('Error fetching crops:', error)
    })
})

const filteredWeighings = computed(() => {
  let localWeighings = weighings.value

  if (dateFrom.value !== '') {
    localWeighings = localWeighings.filter(
      (weighing) => new Date(weighing.recorded_at) >= new Date(dateFrom.value),
    )
  }

  if (dateTo.value !== '') {
    localWeighings = localWeighings.filter(
      (weighing) => new Date(weighing.recorded_at) <= new Date(dateTo.value + 'T23:59:59'),
    )
  }

  if (selectedVehicles.value.length > 0) {
    localWeighings = localWeighings.filter((weighing) =>
      selectedVehicles.value.includes(weighing.vehicle.id),
    )
  }

  if (selectedField.value !== '') {
    localWeighings = localWeighings.filter(
      (weighing) => weighing.field_crop.field.id === Number(selectedField.value),
    )
  }

  if (selectedCrop.value !== '') {
    localWeighings = localWeighings.filter(
      (weighing) => weighing.field_crop.crop.id === Number(selectedCrop.value),
    )
  }

  return localWeighings
})

const onSelectDateFrom = (date) => {
  dateFrom.value = date
}

const onSelectDateTo = (date) => {
  dateTo.value = date
}

const onUpdateSelectedVehicles = (vehicles) => {
  selectedVehicles.value = [...vehicles]
}

const onUpdateSelectedField = (field) => {
  selectedField.value = field
}

const onUpdateSelectedCrop = (crop) => {
  selectedCrop.value = crop
}
</script>
