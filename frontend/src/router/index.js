import { createRouter, createWebHistory } from 'vue-router'
import WeighingsList from '@/views/Harvest/WeighingsList.vue'
import WeighingForm from '@/views/Harvest/WeighingForm.vue'
import HarvestView from '@/views/Harvest/HarvestView.vue'
import WeightView from '@/views/Weight/WeightView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/harvest',
      component: HarvestView,
      children: [
        {
          path: 'weighings',
          component: WeighingsList,
        },
        {
          path: 'weighings/add',
          component: WeighingForm,
          props: { mode: 'add' },
        },
        {
          path: 'weighings/:id/edit',
          component: WeighingForm,
          props: { mode: 'edit' },
        },
        {
          path: 'weighings/:id/show',
          component: WeighingForm,
          props: { mode: 'show' },
        },
      ],
    },
    {
      path: '/weight',
      component: WeightView,
    }
  ],
})

export default router
