<template>
  <select class="border rounded min-w-52 px-3 py-2" v-model="model">
    <option :value="null" disabled>{{ title }}</option>
    <option v-for="item in items" :key="item.id" :value="item.id">
      {{ getItemName(item) }}
    </option>
  </select>
</template>

<script setup>
const { items, title } = defineProps({
  items: {
    type: Array,
    required: true,
  },
  title: {
    type: String,
    required: true,
  },
})

const model = defineModel()

const getItemName = (item) => {
  if (item.name) return item.name
  if (item.field && item.crop) return `${item.field.name} - ${item.crop.name}`
  return 'Neznámy názov'
}
</script>
