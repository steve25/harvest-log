<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <header>
    <nav class="bg-white shadow mb-6">
      <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
        <div class="text-xl font-bold text-gray-800">Harvest Log</div>
        <div class="space-x-6 hidden sm:flex">
          <RouterLink to="/" class="text-gray-600 hover:text-blue-600">Vazenie</RouterLink>
        </div>
      </div>
    </nav>
  </header>

  <RouterView />
</template>
