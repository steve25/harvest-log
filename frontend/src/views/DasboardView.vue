<template>
  <!-- Main Container -->
  <div class="max-w-6xl mx-auto bg-white shadow rounded-2xl p-6">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Posledne vazenia</h1>
      <RouterLink class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" to="/add">
        + Nove vazenie
      </RouterLink>
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
          <tr class="bg-gray-50 text-sm md:text-base">
            <th class="py-2 px-3">Datum</th>
            <th class="py-2 px-3">Vozidlo</th>
            <th class="py-2 px-3">Pole / Plodina</th>
            <th class="py-2 px-3">Data</th>
            <th class="py-2 px-3">Vahy</th>
            <th class="py-2 px-3">Netto</th>
            <th class="py-2 px-3">Odoslane do</th>
          </tr>
        </thead>
        <tbody class="divide-y">
          <tr
            :class="!weighing.recorded_at ? 'border-b-4 border-red-500' : ''"
            v-for="weighing in filteredWeighings"
            :key="weighing.id"
          >
            <td class="py-2 px-3 text-sm">
              <p class="whitespace-nowrap">
                {{ formatDate(weighing.recorded_at || weighing.start_record_at) }}
              </p>
              <p>{{ formatTime(weighing.recorded_at || weighing.start_record_at) }}</p>
            </td>
            <!-- <td class="text-center">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                :class="{
                  'text-green-500': weighing.coming_weight_kg > weighing.leaving_weight_kg,
                  'text-red-500': weighing.leaving_weight_kg > weighing.coming_weight_kg,
                  'text-gray-400': !(
                    weighing.coming_weight_kg > weighing.leaving_weight_kg ||
                    weighing.leaving_weight_kg > weighing.coming_weight_kg
                  ),
                }"
                class="inline-block md:scale-150"
              >
                <path
                  d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8.009 8.009 0 0 1-8 8z"
                />
                <path
                  fill="currentColor"
                  d="M12 10.586 8.707 7.293 7.293 8.707 12 13.414l4.707-4.707-1.414-1.414L12 10.586z"
                />
                <path
                  fill="currentColor"
                  d="m12 14.586-3.293-3.293-1.414 1.414L12 17.414l4.707-4.707-1.414-1.414L12 14.586z"
                />
              </svg>
            </td> -->
            <td class="py-2 px-3">
              <p>{{ weighing.vehicle.plate_number }}</p>
              <p class="hidden md:block">{{ weighing.vehicle.name }}</p>
            </td>
            <td class="py-2 px-3">
              <p>{{ weighing.field_crop.field.name }}</p>
              <p>{{ weighing.field_crop.crop.name }}</p>
            </td>
            <td class="py-2 px-3">
              <!-- <div class="inline-grid [grid-template-columns:auto_auto] gap-x-3"> -->
              <!-- <span>Vlhkost:</span> -->
              <p>{{ weighing.moisture ? weighing.moisture + '%' : '' }}</p>
              <!-- <p>Objemovka:</p> -->
              <p class="whitespace-nowrap">
                {{ weighing.bulk_density ? weighing.bulk_density + ' kg/m³' : '' }}
              </p>
              <!-- </div> -->
            </td>
            <td class="py-2 px-3">
              <div class="inline-grid [grid-template-columns:auto_auto] gap-x-3 text-sm">
                <span>Brutto:</span>
                <span class="whitespace-nowrap">
                  {{
                    weighing.coming_weight_kg > weighing.leaving_weight_kg
                      ? weighing.coming_weight_kg || 0
                      : weighing.leaving_weight_kg || 0
                  }}
                  kg
                </span>
                <span>Tara:</span>
                <span class="whitespace-nowrap">
                  {{
                    weighing.coming_weight_kg < weighing.leaving_weight_kg
                      ? weighing.coming_weight_kg || 0
                      : weighing.leaving_weight_kg || 0
                  }}
                  kg
                </span>
              </div>
            </td>
            <td class="py-2 px-3 whitespace-nowrap">
              {{
                weighing.netto_weight_kg ??
                (weighing.coming_weight_kg > weighing.leaving_weight_kg
                  ? weighing.coming_weight_kg
                  : weighing.leaving_weight_kg)
              }}
              kg
            </td>
            <td class="py-2 px-3 whitespace-nowrap">
              {{ weighing.storage?.name }}
            </td>
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
import { formatDate, formatTime } from '@/utils'

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
      console.log(weighings.value)
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
