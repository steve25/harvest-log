<template>
  <div class="relative inline-block text-left min-w-52">
    <button
      @click="dropdownOpen = !dropdownOpen"
      type="button"
      class="w-full inline-flex justify-between items-center px-3 py-2 text-gray-900 bg-white border border-gray-900 rounded"
      id="filterDropdown"
      aria-expanded="true"
      aria-haspopup="true"
    >
      {{ title }}
      <svg class="w-4 h-4 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
    </button>

    <div
      v-if="dropdownOpen"
      class="absolute right-0 left-0 z-20 mt-2 origin-top-right rounded-lg bg-white border border-gray-200 shadow-md"
    >
      <div class="p-3 space-y-2 text-gray-700" v-for="item in items" :key="item.id">
        <label class="flex items-center space-x-2">
          <input
            type="checkbox"
            class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
            v-model="selectedItems"
            :value="item.id"
          />
          <span>{{ item.name }}</span>
        </label>
      </div>
      <div class="m-2 flex justify-evenly gap-4">
        <button
          class="bg-gray-200 whitespace-nowrap border border-gray-900 rounded py-1 px-2 cursor-pointer"
          @click="selectedItems = items.map((i) => i.id)"
        >
          Select All
        </button>
        <button
          class="bg-gray-200 whitespace-nowrap border border-gray-900 rounded py-1 px-2 cursor-pointer"
          @click="selectedItems = []"
        >
          Clear
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const dropdownOpen = ref(false)

const { title, items } = defineProps({
  title: {
    type: String,
    required: true,
  },
  items: {
    type: Array,
    required: true,
  },
})

const selectedItems = defineModel()
</script>
