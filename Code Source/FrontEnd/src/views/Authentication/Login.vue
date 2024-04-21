
  <script>
    import Logo from "@/components/Essential/Logo.vue";
    import Input from "@/components/Essential/Input.vue";
    import { reactive } from "vue";

    export default {
      name: "Login",
      setup() {
        let credentials = reactive({email: '', password: '', });


      },
      components: {
        Logo, Input
      }
    }
  </script>

  <template>
    <main class="bg-red-50 flex flex-col justify-center items-center" style="min-height: 100vh;" >
      <section class="w-[80%] lg:w-[30%] " >
        <div>
          <Logo link-to="/" icon="logos/logo.png" />
          <p class="text-lg font-bold text-[20px] mt-[2px]" >log in to your account !</p>
        </div>

        <form
            @submit.prevent=""
            class="flex flex-col gap-y-2 mt-6"
        >
          <Input type="email" placeholder="email address" />
          <Input type="password" placeholder="password" />

          <button class="bg-gray-500" >log in</button>
        </form>

      </section>
    </main>
  </template>