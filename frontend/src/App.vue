<template>
  <header class="mb-6">
    <nav class="bg-white shadow">
      <div class="max-w-6xl mx-auto p-2 sm:p-4 flex justify-between items-center">
        <div class="text-lg md:text-xl font-bold text-gray-800">Farm system</div>
        <HamburgerMenu class="sm:hidden cursor-pointer" @click="toggleMenu" />
        <div class="space-x-6 hidden sm:flex">
          <RouterLink
            v-for="link in navLinks"
            :key="link.to"
            :to="link.to"
            class="text-gray-600 hover:text-blue-600"
          >
            {{ link.label }}
          </RouterLink>
        </div>
      </div>
    </nav>
    <transition name="fade">
      <div
        v-if="isHamburgerOpen"
        class="sm:hidden rounded-b-xl bg-white shadow-md border border-gray-200 p-4 space-y-3"
      >
        <RouterLink
          v-for="link in navLinks"
          :key="link.to + '-mobile'"
          :to="link.to"
          class="block text-gray-800 px-4 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors duration-150"
          @click="closeMenu"
        >
          {{ link.label }}
        </RouterLink>
      </div>
    </transition>
  </header>

  <RouterView />
</template>

<script setup>
import { RouterLink, RouterView } from 'vue-router'
import HamburgerMenu from './assets/icons/HamburgerMenu.vue'
import { ref } from 'vue'

const isHamburgerOpen = ref(false)

const toggleMenu = () => {
  isHamburgerOpen.value = !isHamburgerOpen.value
}

const closeMenu = () => {
  isHamburgerOpen.value = false
}

const navLinks = [
  { to: '/weighings/list', label: 'Žatva' },
  { to: '/weighings', label: 'Vozidlá' },
]
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.2s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
