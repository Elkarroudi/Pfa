
  import { createRouter, createWebHistory } from 'vue-router'
  import HomePage from "@/views/website/HomePage.vue";

  const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
      {
        path: '/',
        name: 'home',
        component: HomePage,
      },
      {
        path: '/login',
        name: 'login',
        component: () => import('../views/Authentication/Login.vue'),
      },

    ]
  })

  export default router
