
  <script>
    import Button from "@/components/Essential/Button.vue";
    import Logo from "@/components/Essential/Logo.vue";
    import check from "../../../constants/TokenManager.js";
    import { checkUserType } from "../../../functions/Authentication.js";
    import { reactive } from "vue";

    export default {
      name: "Header",
      setup() {
        let data = reactive({ authorized : false, userType: '', });
        let userProfile = reactive({link: '/admin/', });

        async function checkAuthorization() {
          let response = await check(data.userType);
          data.authorized = response.status;
          data.userType = response.userType;
          checkUserType(data, userProfile);
        } checkAuthorization();

        return { data, userProfile, };
      },
      components: {
          Button, Logo,
      },
    }
  </script>

  <template>
    <header class="w-[100%] bg-gray-200 h-[80px]" >
      <div class="w-[85%] h-[100%] m-auto flex justify-between items-center" >

        <Logo link-to="/" icon="/logos/logo.png" />

        <nav v-if="!data.authorized" class="flex gap-x-4" >
          <Button type="third" link-to="/jobs" > jobs </Button>
          <Button type="secondary" link-to="/login" icon="/icons/login.png" > login </Button>
          <Button type="primary" link-to="/register" > register </Button>
        </nav>
        <nav v-else class="flex gap-x-4" >
          <Button type="third" :link-to="userProfile.link" icon="/icons/login.png" > Account </Button>
          <Button type="warning" link-to="/logout" icon="/icons/logout.png" > log out </Button>
        </nav>

      </div>
    </header>
  </template>
