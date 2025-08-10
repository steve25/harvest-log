<template>
  <h2>Aktualna vaha je: {{ weightStore.weight.weight }} kg</h2>
</template>

<script setup>
import { useWeightStore } from '@/stores/weightStore.js'
import { onBeforeUnmount, onMounted } from 'vue'

const weightStore = useWeightStore()

onMounted(() => {
  weightStore.startAutoRefresh()
})

onBeforeUnmount(weightStore.stopAutoRefresh())
</script>
