import { createRouter, createWebHistory } from 'vue-router'
import Inscripciones from '../views/InscripcionesView.vue'
import Nueva from '../views/NuevaInscripcionView.vue'
import Editar from '../views/EditarView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Inscripciones
    },
    {
      path: '/nueva',
      name: 'nueva',
      component: Nueva
    },
    {
      path: '/editar/:id',
      name: 'editar',
      component: Editar
    }
    
   
  ]
})

export default router
