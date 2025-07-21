import { createRouter, createWebHistory } from 'vue-router'
import WeighingsList from '../views/Weighings/WeighingsList.vue'
import WeighingForm from '../views/Weighings/WeighingForm.vue'
import WeighingView from '@/views/Weighings/WeighingView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/weighings',
      component: WeighingView,
      children: [
        {
          path: 'list',
          component: WeighingsList,
        },
        {
          path: 'add',
          component: WeighingForm,
          props: { mode: 'add' },
        },
        {
          path: ':id/edit',
          component: WeighingForm,
          props: { mode: 'edit' },
        },
        {
          path: ':id/show',
          component: WeighingForm,
          props: { mode: 'show' },
        },
      ],
    },
  ],
})

export default router
