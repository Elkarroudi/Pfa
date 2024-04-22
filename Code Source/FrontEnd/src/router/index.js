
  import { createRouter, createWebHistory } from 'vue-router'
  import HomePage from "@/views/website/HomePage.vue";

  const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [

      /* Website Routes */
      { path: '/', name: 'Home', component: HomePage, },

      /* Authentication */
      { path: '/login', name: 'Login', component: () => import('../views/Authentication/Login.vue'), },
      { path: '/register', name: 'Registration', component: () => import('../views/Authentication/Registration.vue'), },
      { path: '/logout', name: 'Logout', component: () => import('../views/Authentication/Logout.vue'), },

      /* Admin Routes */
      { path: '/admin/profile/', name: 'AdminProfile', component: () => import('../views/Admin/Profile.vue'), },
    ]
  })

  export default router
