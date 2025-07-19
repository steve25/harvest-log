<template>
  <tr :class="isIncomplete ? 'border-b-4 border-red-500' : ''">
    <td class="py-2 px-3 text-sm">
      <p class="whitespace-nowrap">
        {{ formatDate(recordTime) }}
      </p>
      <p>{{ formatTime(recordTime) }}</p>
    </td>
    <!-- <td class="text-center">
      <WeighingTrendIcon
        :coming="weighing.coming_weight_kg"
        :leaving="weighing.leaving_weight_kg"
      />
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
      <p>{{ moistureText }}</p>
      <p class="whitespace-nowrap">
        {{ densityText }}
      </p>
    </td>
    <td class="py-2 px-3">
      <div class="inline-grid [grid-template-columns:auto_auto] gap-x-3 text-sm">
        <span>Brutto:</span>
        <span class="whitespace-nowrap">
          {{ weights.brutto }}
          kg
        </span>
        <span>Tara:</span>
        <span class="whitespace-nowrap">
          {{ weights.tara }}
          kg
        </span>
      </div>
    </td>
    <td class="py-2 px-3 whitespace-nowrap">
      {{ weights.netto }}
      kg
    </td>
    <td class="py-2 px-3 whitespace-nowrap">
      {{ weighing.storage?.name }}
    </td>
  </tr>
</template>

<script setup>
import { formatDate, formatTime } from '@/utils'
import { computed } from 'vue'

const { weighing } = defineProps({
  weighing: { type: Object, required: true },
})

const weights = computed(() => {
  const coming = Number(weighing.coming_weight_kg) || 0
  const leaving = Number(weighing.leaving_weight_kg) || 0
  const netto = weighing.netto_weight_kg ?? Math.abs(coming - leaving)

  return {
    brutto: Math.max(coming, leaving),
    tara: Math.min(coming, leaving),
    netto,
  }
})

const moistureText = computed(() => (weighing.moisture ? `${weighing.moisture}%` : ''))

const densityText = computed(() => (weighing.bulk_density ? `${weighing.bulk_density} kg/m³` : ''))

const isIncomplete = computed(() => !weighing.recorded_at)

const recordTime = computed(() => weighing.recorded_at || weighing.start_record_at)
</script>
