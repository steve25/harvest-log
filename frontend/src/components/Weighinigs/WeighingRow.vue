<template>
  <tr :class="isIncomplete && isMd ? 'border-b-4 border-red-500' : ''" class="align-top">
    <td class="py-2 px-3 text-sm whitespace-nowrap">
      <p>{{ formatDate(recordTime) }}</p>
      <p class="text-gray-500">{{ formatTime(recordTime) }}</p>
    </td>
    <!-- <td class="text-center">
      <WeighingTrendIcon
        :coming="weighing.coming_weight_kg"
        :leaving="weighing.leaving_weight_kg"
      />
    </td> -->
    <td class="py-2 px-3">
      <p class="font-semibold">{{ weighing.vehicle.plate_number }}</p>
      <p class="hidden sm:block text-sm text-gray-600">{{ weighing.vehicle.name }}</p>
    </td>
    <td class="py-2 px-3">
      <p>{{ weighing.field_crop.field.name }}</p>
      <p class="text-sm text-gray-600">{{ weighing.field_crop.crop.name }}</p>
    </td>
    <td class="hidden sm:table-cell py-2 px-3">
      <p>{{ moistureText }}</p>
      <p>{{ densityText }}</p>
    </td>
    <td class="hidden sm:table-cell py-2 px-3">
      <div class="grid grid-cols-[auto_auto] gap-x-2 text-sm">
        <span>Brutto:</span>
        <span>{{ weights.brutto }}kg</span>
        <span>Tara:</span>
        <span>{{ weights.tara }}kg</span>
      </div>
    </td>
    <td class="py-2 px-3 font-medium">{{ weights.netto }}kg</td>
    <td class="hidden sm:table-cell py-2 px-3 whitespace-nowrap">
      {{ weighing.storage?.name }}
    </td>
  </tr>
  <tr class="sm:hidden align-top border-b-2 border-gray-200">
    <td colspan="100%" class="px-3 py-2 text-sm text-gray-800">
      <div class="flex gap-4 justify-between">
        <div class="flex-1 min-w-[40%]">
          <p class="font-semibold mb-1 text-gray-600">Parametre</p>
          <p>
            Vlhkosť: <span class="font-bold text-black">{{ moistureText }}</span>
          </p>
          <p>
            Hustota: <span class="font-bold text-black">{{ densityText }}</span>
          </p>
        </div>

        <div class="flex-1 min-w-[40%]">
          <p class="font-semibold mb-1 text-gray-600">Váhy</p>
          <p>
            Brutto: <span class="font-bold text-black">{{ weights.brutto }} kg</span>
          </p>
          <p>
            Tara: <span class="font-bold text-black">{{ weights.tara }} kg</span>
          </p>
        </div>
      </div>
    </td>
  </tr>
  <tr
    :class="isIncomplete && isSm ? 'border-b-4 border-red-500' : ' border-gray-800'"
    class="sm:hidden align-top border-b-2"
  >
    <td colspan="100%" class="px-3 py-2 text-sm text-gray-800 pb-5">
      <div class="flex gap-4 justify-between">
        <div class="flex-1 min-w-[40%]">
          <p class="font-semibold mb-1 text-gray-600">Preprava</p>
          <p>
            Vozidlo: <span class="font-bold text-black">{{ weighing.vehicle?.name }}</span>
          </p>
          <p>
            Sklad: <span class="font-bold text-black">{{ weighing.storage?.name }}</span>
          </p>
        </div>

        <div class="flex-1 min-w-[40%]"></div>
      </div>
    </td>
  </tr>
</template>

<script setup>
import { formatDate, formatTime } from '@/utils'
import { computed } from 'vue'
import { useBreakpoints } from '@vueuse/core'

const breakpoints = useBreakpoints({ sm: 640, md: 768, lg: 1024, xl: 1280, '2xl': 1536 })

const isSm = breakpoints.smaller('md')
const isMd = breakpoints.greater('md')

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

const densityText = computed(() => (weighing.bulk_density ? `${weighing.bulk_density}kg/m³` : ''))

const isIncomplete = computed(() => !weighing.recorded_at)

const recordTime = computed(() => weighing.recorded_at || weighing.start_record_at)
</script>
