
  <script>
    import RecruiterDashLayout from "@/components/Layouts/RecruiterDashLayout.vue";
    import Profile from "@/views/Admin/Profile.vue";
    import Settings from "@/views/Admin/Settings.vue";
    import DashboardLayout from "@/components/Layouts/DashboardLayout.vue";
    import Listings from "@/views/Recruiter/Listings.vue";
    import Applications from "@/views/Recruiter/Applications.vue";
    import Statistics from "@/views/Recruiter/Statistics.vue";

    export default {
      name: "RecruiterAccount",
      components: {
        DashboardLayout,
        RecruiterDashLayout, Profile, Settings, Listings, Applications, Statistics,
      },
      data:() => ({
        currentPage: 'Statistics'
      }),

    }
  </script>

  <template>
    <RecruiterDashLayout @change-page="currentPage = $event" >
      <template v-slot:content   >

        <section>
          <h1 class="font-[900] text-3xl" >admin / {{ currentPage.toLowerCase() }} </h1>
          <p class="font-[600] text-xl" >a new way of controlling data ! </p>

          <div class="mt-10">
            <component :is="currentPage" ></component>
          </div>
        </section>

      </template>
    </RecruiterDashLayout>
  </template>