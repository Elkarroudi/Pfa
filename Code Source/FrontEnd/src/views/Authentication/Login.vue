
  <script>
    import Logo from "@/components/Essential/Logo.vue";
    import FormBtn from "@/components/Essential/FormBtn.vue";
    import Input from "@/components/Essential/Input.vue";
    import Button from "@/components/Essential/Button.vue";
    import Errors from "@/components/Essential/Errors.vue";
    import { reactive } from "vue";
    import { login } from "../../../functions/Authentication.js";
    import { useRouter, useRoute } from "vue-router";
    import Success from "@/components/Essential/Success.vue";

    export default {
      name: "Login",
      setup() {
        let router = useRouter();
        let route = useRoute();
        let errors = reactive({content: [], });
        let credentials = reactive({email: route.query.email || '', password: '', });

        const handleLogin = async () => {
          if (await login(credentials, errors)) { await router.push({path: '/', query: { msg: 'login successfully !!' } }); }
        }
        return { credentials, handleLogin, errors, };
      },
      components: {
        Logo, Input, FormBtn, Button, Errors, Success,
      },
    }
  </script>

  <template>
    <main class="flex flex-col justify-center items-center" style="min-height: 100vh;" >
      <section class="w-[80%] lg:w-[35%] " >
        <div>
          <Logo link-to="/" icon="logos/logo.png" />
          <p class="text-lg font-bold text-[20px] mt-[2px]" >log in to your account !</p>
        </div>

        <Errors :data="errors.content" />
        <Success :msg-to-expect="$route.query.msg" />

        <form
            @submit.prevent="handleLogin"
            class="flex flex-col gap-y-2 mt-6"
        >
          <Input type="email" placeholder="email address" v-model="credentials.email" />
          <Input type="password" placeholder="password" v-model="credentials.password" />
          <FormBtn type="primary" >log in to your account !</FormBtn>
        </form>

        <p class="text-right mt-2" > don't have an account ? <RouterLink to="/register" class="text-blue-600 underline" >register now</RouterLink></p>
      </section>
    </main>
  </template>