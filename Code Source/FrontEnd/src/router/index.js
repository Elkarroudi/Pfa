
  import {createRouter, createWebHistory, useRouter} from 'vue-router'
  import HomePage from "@/views/website/HomePage.vue";
  import check from "../../constants/TokenManager.js";

  let pageRouter = useRouter();
  const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
      { path: '/', name: 'Home', component: HomePage, },
      { path: '/jobs', name: 'Jobs', component: () => import('../views/website/Jobs.vue'), },
      { path: '/jobs/:id', name: 'JobDetails', component: () => import('../views/website/JobDetail.vue'), },
      { path: '/login', name: 'Login', component: () => import('../views/Authentication/Login.vue'), },
      { path: '/register', name: 'Registration', component: () => import('../views/Authentication/Registration.vue'), },
      { path: '/logout', name: 'Logout', component: () => import('../views/Authentication/Logout.vue'), },
      {
        path: '/admin',
        name: 'AdminProfile',
        component: () => import('../views/Admin/Account.vue'),
        async beforeEnter() {
            let response = await check();
            if (response.status) {
              if (response.userType !== 'Admin') {
                alert('unauthenticated or forbidden to access this page !');
                return await pageRouter.push('/');
              }
            }
        },
      },
      {
        path: '/recruiter',
        name: 'RecruiterProfile',
        component: () => import('../views/Recruiter/RecruiterAccount.vue'),
      },
      {
        path: '/seeker',
        name: 'SeekerProfile',
        component: () => import('../views/Seeker/SeekerAccount.vue'),
      },

    ]
  })

  export default router
