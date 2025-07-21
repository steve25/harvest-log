<template>
  <div>
    <div
      v-if="confirm.isOpen"
      class="fixed inset-0 bg-gray-900/80 flex items-center justify-center z-50"
    >
      <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md transform transition-all">
        <h2 class="text-xl font-semibold text-red-600 mb-2">Si si istý?</h2>
        <p class="text-gray-600 mb-6">{{ confirm.message }}</p>
        <div class="flex justify-end space-x-3">
          <button
            class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400"
            @click="confirm.cancel"
          >
            Zrušiť
          </button>
          <button
            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700"
            @click="confirm.accept"
          >
            Vymazať
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useConfirmStore } from '@/stores/confirmStore'

const confirm = useConfirmStore()
</script>
