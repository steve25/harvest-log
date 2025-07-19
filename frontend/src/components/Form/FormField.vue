<template>
  <div class="flex flex-col gap-2">
    <label v-if="label" :for="id" class="text-sm font-medium text-gray-700">{{ label }}</label>
    <slot />
    <div v-if="hasErrors" class="text-sm text-red-600">
      <p v-for="error in errors" :key="error">
        {{ error }}
      </p>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const { id, label, errors } = defineProps({
  id: String,
  label: String,
  errors: { type: Array, default: () => [] },
})

const hasErrors = computed(() => errors && errors.length > 0)
</script>
