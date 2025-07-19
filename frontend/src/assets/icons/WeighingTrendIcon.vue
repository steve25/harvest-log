<template>
  <svg
    xmlns="http://www.w3.org/2000/svg"
    width="24"
    height="24"
    viewBox="0 0 24 24"
    :class="iconStyle"
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
</template>

<script setup>
import { computed } from 'vue'

const { coming, leaving } = defineProps({
  coming: { type: Number },
  leaving: { type: Number },
})

const iconStyle = computed(() => {
  if (coming > leaving) return 'text-green-500'
  if (leaving > coming) return 'text-red-500 rotate-180'
  return 'text-gray-400 rotate-90'
})
</script>
