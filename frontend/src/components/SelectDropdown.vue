<template>
  <div class="relative inline-block text-left">
    <button
      @click="dropdownOpen = !dropdownOpen"
      type="button"
      class="w-full inline-flex justify-between items-center px-3 py-2 text-gray-900 bg-white border border-gray-900 rounded"
      id="filterDropdown"
      aria-expanded="true"
      aria-haspopup="true"
    >
      {{ props.title }}
      <svg class="w-4 h-4 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
    </button>

    <!-- Dropdown menu -->
    <div
      v-if="dropdownOpen"
      class="absolute right-0 left-0 z-20 mt-2 origin-top-right rounded-lg bg-white border border-gray-200 shadow-md"
    >
      <div class="p-3 space-y-2 text-gray-700" v-for="item in props.items" :key="item.id">
        <label class="flex items-center space-x-2">
          <input
            @change="changeSelectedItems"
            type="checkbox"
            class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
            v-model="selectedItems"
            :value="item.id"
          />
          <span>{{ item.name }}</span>
        </label>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const dropdownOpen = ref(false)
const selectedItems = ref([])

const props = defineProps({
  title: {
    type: String,
    required: true,
  },
  items: {
    type: Array,
    required: true,
  },
})

const emit = defineEmits(['selectItems'])

const changeSelectedItems = () => {
  emit('selectItems', selectedItems.value)
}
</script>
