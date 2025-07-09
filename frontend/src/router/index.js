import { createRouter, createWebHistory } from 'vue-router'
import DashboardView from '../views/DasboardView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'weighting',
      component: DashboardView,
    },
  ],
})

export default router
