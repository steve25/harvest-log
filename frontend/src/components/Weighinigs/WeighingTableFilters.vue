<template>
  <div class="flex flex-wrap gap-x-4 gap-y-3 mb-4">
    <DateFilter id="date-from" v-model="dateFrom" placeholder="Od" />
    <DateFilter id="date-to" v-model="dateTo" placeholder="Do" />
    <SelectDropdown title="Vozidla" :items="reference.vehicles" v-model="selectedVehicle" />
    <DropdownMenu title="Pole" :items="reference.fields" v-model="selectedField" />
    <DropdownMenu title="Plodina" :items="reference.crops" v-model="selectedCrop" />
    <SelectDropdown title="Sklad" :items="reference.storages" v-model="selectedStorage" />

    <button
      @click="clearFilter"
      class="bg-gray-200 whitespace-nowrap border border-gray-900 rounded px-3 py-2 cursor-pointer"
    >
      Zrus filter
    </button>
  </div>
</template>

<script setup>
import DateFilter from '@/components/Form/DateFilter.vue'
import SelectDropdown from '@/components/Form/SelectDropdown.vue'
import DropdownMenu from '@/components/Form/DropdownMenu.vue'

import { computed, onMounted, ref, watch } from 'vue'

import { useReferenceStore } from '@/stores/referenceStore'

const dateFrom = ref('')
const dateTo = ref('')
const selectedVehicle = ref([])
const selectedField = ref(null)
const selectedCrop = ref(null)
const selectedStorage = ref([])

const { weighings } = defineProps({
  weighings: Object,
})

const reference = useReferenceStore()

onMounted(() => {
  reference.fetch({ vehicles: true, fields: true, crops: true, storages: true })
})

const emit = defineEmits(['update-filter'])

const filteredWeighings = computed(() => {
  let localWeighings = weighings

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

  if (selectedVehicle.value.length > 0) {
    localWeighings = localWeighings.filter((weighing) =>
      selectedVehicle.value.includes(weighing.vehicle.id),
    )
  }

  if (selectedField.value !== null) {
    localWeighings = localWeighings.filter(
      (weighing) => weighing.field_crop.field.id === Number(selectedField.value),
    )
  }

  if (selectedCrop.value !== null) {
    localWeighings = localWeighings.filter(
      (weighing) => weighing.field_crop.crop.id === Number(selectedCrop.value),
    )
  }

  if (selectedStorage.value.length > 0) {
    localWeighings = localWeighings.filter((weighing) =>
      selectedStorage.value.includes(weighing.storage_id),
    )
  }

  return localWeighings
})

watch(
  filteredWeighings,
  (newVal) => {
    emit('update-filter', newVal)
  },
  { immediate: true },
)

const clearFilter = () => {
  dateFrom.value = ''
  dateTo.value = ''
  selectedVehicle.value = []
  selectedField.value = null
  selectedCrop.value = null
  selectedStorage.value = []
}
</script>
