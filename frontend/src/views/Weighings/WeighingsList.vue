<template>
  <div class="max-w-6xl mx-auto bg-white shadow rounded-2xl p-6">
    <div class="flex justify-between items-center mb-6">
      <h1 class="font-bold sm:text-xl md:text-2xl">Posledne vazenia</h1>
      <RouterLink
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
        to="/weighings/add"
      >
        + Nove vazenie
      </RouterLink>
    </div>
    <ConfirmDialog />

    <TableFilters :weighings="weighingsStore.weighings" @update-filter="onUpdateFilter" />

    <div v-if="weighingsStore.loading" class="text-center p-6 text-gray-500">Načítavam dáta...</div>
    <div v-else-if="weighingsStore.error" class="text-center p-6 text-red-500">
      Cant fetch data...
    </div>

    <div v-else class="overflow-x-auto">
      <table class="w-full text-left border-t border-b">
        <thead>
          <tr class="bg-gray-50 text-sm md:text-base">
            <th class="py-2 px-3">Datum</th>
            <th class="py-2 px-3">Vozidlo</th>
            <th class="hidden sm:table-cell py-2 px-3">Vahy</th>
            <th class="py-2 px-3">Netto</th>
            <th class="py-2 px-3">
              Pole /<br />
              Plodina
            </th>
            <th class="hidden sm:table-cell py-2 px-3">Parametre</th>
            <th class="hidden sm:table-cell py-2 px-3">Sklad</th>
            <th class="py-2 px-3">Akcia</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-300">
          <WeighingRow
            v-for="weighing in filteredWeighings"
            :key="weighing.id ?? weighing.start_record_at"
            :weighing="weighing"
          />
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { RouterLink } from 'vue-router'

import TableFilters from '@/components/Weighinigs/WeighingTableFilters.vue'
import WeighingRow from '@/components/Weighinigs/WeighingRow.vue'

import ConfirmDialog from '@/components/ConfirmDialog.vue'
import { useWeighingsStore } from '@/stores/wighingsStore'

const weighingsStore = useWeighingsStore()

const filteredWeighings = ref([])

onMounted(async () => {
  await weighingsStore.fetchWeighings()
  filteredWeighings.value = weighingsStore.weighings
})

const onUpdateFilter = (filteredData) => {
  filteredWeighings.value = filteredData
}
</script>
