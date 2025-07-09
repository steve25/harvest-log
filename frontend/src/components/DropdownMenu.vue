<template>
  <select class="border rounded px-3 py-2" @change="changeSelectedItems">
    <option value="">{{ title }}</option>
    <option v-for="item in items" :key="item.id" :value="item.id">{{ item.name }}</option>
  </select>
</template>

<script setup>
defineProps({
  items: {
    type: Array,
    required: true,
  },
  title: {
    type: String,
    required: true,
  },
})

const emit = defineEmits(['select-items'])

const changeSelectedItems = (e) => {
  emit('select-items', e.target.value)
}
</script>
