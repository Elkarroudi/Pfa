
  <script>
    import Logo from "@/components/Essential/Logo.vue";
    import Success from "@/components/Essential/Success.vue";

    export default {
      name: "DashboardLayout",
      setup() {
        let links = [
          { name: 'Statistics', icon: 'statistics.png', },
          { name: 'Users', icon: 'users.png', },
          { name: 'Companies', icon: 'company.png', },
          { name: 'Profile', icon: 'profile.png', },
          { name: 'Settings', icon: 'settings.png', },
        ];

        return { links, };
      },
      methods: {
        changeCurrentPage(component) {
          this.$emit('change-page', component);
        }
      },
      components: {Success, Logo}
    }
  </script>

  <template>
    <main class="w-[100%] h-[100vh] flex justify-between px-[20px] py-[50px]" >

      <nav class="w-[19%] h-[100%]  bg-gray-300 px-8 py-[30px] rounded border-2 border-gray-500 border-r-[5px] border-r-gray-800" >
        <ul class="flex flex-col gap-y-2" >

          <li class="flex flex-col gap-y-[2px] mb-6" >
            <Logo link-to="/" icon="/logos/logo.png" />
            <span class="text-lg font-bold" >/ admin dashboard </span>
          </li>

          <li
              v-for="(link, index) in links"
              :key="`dh-links-${index}`"
              class=""
          >
            <button
                @click="changeCurrentPage(link.name)"
                class="flex w-full gap-x-4 items-center bg-gray-100 rounded p-2 border-l-[5px] border-gray-800 hover:bg-gray-200"
            >
              <img :src="`/icons/${link.icon}`" alt="" class="h-[30px]"  />
              <span class="text-lg font-bold" > {{ link.name.toLowerCase() }} </span>
            </button>
          </li>

          <li>
            <RouterLink
                to="/logout"
                class="flex w-full gap-x-4 items-center bg-red-100 rounded p-2 border-l-[5px] border-red-800 hover:bg-red-200"
            >
              <img src="/icons/logout.png" alt="" class="h-[30px]"  />
              <span class="text-lg font-bold" > log out </span>
            </RouterLink>
          </li>

        </ul>
      </nav>

      <section class="overflow-y-scroll w-[80%] h-[100%] bg-gray-100 px-8 py-[30px] rounded border-2 border-gray-500 border-l-[5px] border-l-gray-800" >
        <slot name="content" />
      </section>
    </main>

    <Success :msg-to-expect="$route.query.msg" />
  </template>
