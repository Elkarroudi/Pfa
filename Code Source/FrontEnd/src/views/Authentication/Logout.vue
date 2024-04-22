  <script>
    import { logout} from "../../../functions/Authentication.js";
    import { useRouter } from "vue-router";

    export default {
      name: "Logout",
      setup() {
        let router = useRouter();

        const handleLogin = async () => {
          if (await logout()) { await router.push({path: '/', query: { msg: 'Your Were Logged out successfully !!' } }); }
        }
        handleLogin();
      }
    }
  </script>