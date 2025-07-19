<template>
  <div class="flex items-center text-gray-700 gap-2 min-w-52">
    <label :for="id" class="text-sm whitespace-nowrap">{{ placeholder + ':' }}</label>
    <input
      :id="id"
      v-model="model"
      type="date"
      class="border rounded px-3 py-2 w-full"
      :aria-label="placeholder"
    />
  </div>
</template>

<script setup>
const model = defineModel()
defineProps({
  placeholder: {
    type: String,
    default: 'Vyber datum',
  },
  id: {
    type: String,
  },
})
</script>
