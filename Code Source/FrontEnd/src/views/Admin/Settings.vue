
  <script>
    import Input from "@/components/Essential/Input.vue";
    import FormBtn from "@/components/Essential/FormBtn.vue";
    import Errors from "@/components/Essential/Errors.vue";
    import { reactive } from "vue";
    import { updatePassword } from "../../../functions/Authentication.js";
    import {useRouter} from "vue-router";

    export default {
      name: "Settings",
      setup() {
        let router = useRouter();
        let errors = reactive({content: [], });
        let credential = reactive({ password: '', });

        const handlePasswordUpdate = async () => {
          await updatePassword(errors, credential);
        }

        return { errors, credential, handlePasswordUpdate, };
      },
      components: {
        Input, FormBtn, Errors,
      }
    }
  </script>

  <template>
    <div class="w-full border-2 border-gray-400 bg-gray-300 rounded px-6 py-4" >
      <h1 class="font-[600] text-xl mb-2" >update your password !</h1>

      <Errors :data="errors.content" />

      <form @submit.prevent="handlePasswordUpdate" class="flex gap-x-4"  >
        <Input placeholder="new password" type="password" v-model="credential.password" />
        <FormBtn>update password</FormBtn>
      </form>

    </div>
  </template>