
  <script>
    import SeekerDashLayout from "@/components/Layouts/SeekerDashLayout.vue";
    import Profile from "@/views/Admin/Profile.vue";
    import Settings from "@/views/Admin/Settings.vue";
    import Bookmark from "@/views/Seeker/Bookmark.vue";
    import Applications from "@/views/Seeker/Applications.vue";
    import Educations from "@/views/Seeker/Educations.vue";
    import Experiences from "@/views/Seeker/Experiences.vue";

    export default {
      name: "SeekerAccount",
      components: {
        SeekerDashLayout, Profile, Settings, Bookmark, Applications, Educations, Experiences
      },
      data:() => ({
        currentPage: 'Profile',
      }),
    }
  </script>

  <template>
    <SeekerDashLayout @change-page="currentPage = $event" >
      <template v-slot:content>
        <section>
          <h1 class="font-[900] text-3xl" >admin / {{ currentPage.toLowerCase() }} </h1>
          <p class="font-[600] text-xl" >a new way of controlling data ! </p>

          <div class="mt-10">
            <component :is="currentPage" ></component>
          </div>
        </section>
      </template>
    </SeekerDashLayout>
  </template>