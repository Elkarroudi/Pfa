
  <script>
    import DashboardLayout from "@/components/Layouts/DashboardLayout.vue";
    import Statistics from "@/views/Admin/Statistics.vue";
    import Users from "@/views/Admin/Users.vue";
    import Companies from "@/views/Admin/Companies.vue";
    import Settings from "@/views/Admin/Settings.vue";
    import Profile from "@/views/Admin/Profile.vue";
    import Listings from "@/views/Admin/Listings.vue";
    import { getStatistics, getUsers, getCompanies,  } from "../../../functions/Admin.js";
    import { reactive } from "vue";

    export default {
      name: "Account",
      setup() {
        let adminData = reactive({ statistics: [], users: [], companies: [], })

        const fetchData = async () => {
          await getStatistics(adminData);
          await getUsers(adminData);
          await getCompanies(adminData);
        }
        fetchData();

        return { adminData, };
      },
      data:() => ({
        currentPage: 'Statistics'
      }),
      components: {
        DashboardLayout, Statistics, Users, Companies, Settings, Profile, Listings,
      },
    }
  </script>

  <template>
    <DashboardLayout :data="currentPage" @change-page="currentPage = $event">
      <template v-slot:content >

        <section>
          <h1 class="font-[900] text-3xl" >admin / {{ currentPage.toLowerCase() }} </h1>
          <p class="font-[600] text-xl" >a new way of controlling data ! </p>

          <div class="mt-10">
            <component :is="currentPage" :data="adminData[currentPage.toLowerCase()]" ></component>
          </div>
        </section>

      </template>
    </DashboardLayout>
  </template>

