
  <script>
    import Logo from "@/components/Essential/Logo.vue";
    import FormBtn from "@/components/Essential/FormBtn.vue";
    import Input from "@/components/Essential/Input.vue";
    import Button from "@/components/Essential/Button.vue";
    import Errors from "@/components/Essential/Errors.vue";
    import { reactive } from "vue";
    import {login, register} from "../../../functions/Authentication.js";
    import { useRouter } from "vue-router";

    export default {
      name: "Registration",
      setup() {
        let router = useRouter();
        let errors = reactive({content: [], });
        let userData = reactive({name: '', email: '', password: '', type: 'seeker', });

        const handleRegistration = async () => {
          if (await register(userData, errors)) { await router.push({path: '/login', query: {
            msg: 'You Have Been successfully Registered, Please Log in!!',
            email: userData.email
          } }); }
        }
        return { userData, handleRegistration, errors, };
      },
      components: {
        Logo, Input, FormBtn, Button, Errors,
      }
    }
  </script>

  <template>
    <main class="flex flex-col justify-center items-center" style="min-height: 100vh;" >
      <section class="w-[80%] lg:w-[35%] " >
        <div>
          <Logo link-to="/" icon="logos/logo.png" />
          <p class="text-lg font-bold text-[20px] mt-[2px]" >create your free account !</p>
        </div>

        <Errors :data="errors.content" />

        <form
            @submit.prevent="handleRegistration"
            class="flex flex-col gap-y-2 mt-6"
        >
          <div class="flex justify-between mb-2" >
            <div
                v-for="userType in ['seeker', 'recruiter']"
                :key="`userType-${userType}`"
                :class="{
                  'w-[45%] bg-gray-200 px-6 py-4 rounded border-2 border-gray-800 flex items-center gap-x-4' : true,
                  'border-l-[10px]' : userData.type === userType,
                }"
            >
              <img :src="`/icons/${userType}.png`" alt="icon" class="w-[45px]">
              <label class="cursor-pointer flex items-center gap-x-2">
                <Input hidden name="type" type="radio" v-model="userData.type" :value="userType" />
                {{ userType }}
                <img v-if="userData.type === userType" class="w-[25px]" src="/icons/checklist.png" alt="icon" >
              </label>
            </div>
          </div>

          <Input type="email" placeholder="email address" v-model="userData.email" />
          <Input type="name" placeholder="full name" v-model="userData.name" />
          <Input type="password" placeholder="password" v-model="userData.password" />
          <FormBtn type="primary" >create your account !</FormBtn>
        </form>

        <p class="text-right mt-2" > you have an account ? <RouterLink to="/login" class="text-blue-600 underline" >login now</RouterLink></p>
      </section>
    </main>
  </template>
