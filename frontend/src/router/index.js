import { createRouter, createWebHistory } from 'vue-router'
import DashboardView from '../views/WeighingsView.vue'
import AddWeighing from '../views/AddWeighing.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'weighting',
      component: DashboardView,
    },
    {
      path: '/add',
      name: 'addWeighting',
      component: AddWeighing,
    },
  ],
})

export default router
