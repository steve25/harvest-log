<template>
  <input
    @input="selectDate"
    type="date"
    class="border rounded px-3 py-2 text-sm text-gray-700"
    placeholder="Od"
  />
</template>

<script setup>
const emit = defineEmits(['select-date'])

const selectDate = (e) => {
  emit('select-date', e.target.value)
}
</script>
