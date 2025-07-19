<template>
  <div class="max-w-6xl mx-auto bg-white shadow rounded-2xl p-6">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Posledne vazenia</h1>
      <RouterLink class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" to="/add">
        + Nove vazenie
      </RouterLink>
    </div>

    <TableFilters :weighings="weighings" @update-filter="onUpdateFilter" />

    <div v-if="loading" class="text-center p-6 text-gray-500">Načítavam dáta...</div>

    <div v-else class="overflow-x-auto">
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
          <WeighingRow
            v-for="weighing in filteredWeighings"
            :key="weighing.id ?? weighing.start_record_at"
            :weighing="weighing"
          />
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
import { ref, onMounted } from 'vue'

import TableFilters from '@/components/Weighinigs/WeighingTableFilters.vue'
import WeighingRow from '@/components/Weighinigs/WeighingRow.vue'

import { getWeighings } from '@/http/weighings'

const weighings = ref([])
const filteredWeighings = ref([])
const loading = ref(true)

onMounted(async () => {
  weighings.value = await getWeighings()
  filteredWeighings.value = weighings.value
  loading.value = false
})

const onUpdateFilter = (filteredData) => {
  filteredWeighings.value = filteredData
}
</script>
