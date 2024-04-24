
  <script>
    import Input from "@/components/Essential/Input.vue";
    import FormBtn from "@/components/Essential/FormBtn.vue";
    import {reactive} from "vue";
    import {useRouter} from "vue-router";
    import Errors from "@/components/Essential/Errors.vue";
    import { getUserData, updateUserData } from "../../../functions/Authentication.js";

    export default {
      name: "Profile",
      setup() {
        let router = useRouter();
        let errors = reactive({content: [], });
        let profileData = reactive({content: [], email: '', name: '', });

        const getData = async () => { await getUserData(profileData);};
        getData();

        const handleInformationUpdate = async () => {
          await updateUserData(errors, profileData);
        }


        return { errors, profileData, handleInformationUpdate  };
      },
      components: {
        Errors,
        Input, FormBtn,
      }
    }
  </script>

  <template>
    <div class="w-full border-2 border-gray-400 bg-gray-300 rounded px-6 py-4" >

      <h1 class="font-[600] text-xl " >related data !</h1>
      <div class="flex flex-col" >
        <span><span class="bg-yellow-500 px-2 rounded" >id :</span> {{ profileData.content.id }}</span>
        <span><span class="bg-yellow-500 px-2 rounded" >username :</span> {{ profileData.content.username }}</span>
        <span><span class="bg-yellow-500 px-2 rounded" >you are an :</span> {{ profileData.content.type }}</span>
      </div>

      <h1 class="font-[600] text-xl mt-8" >update your information !</h1>
      <Errors :data="errors.content" />

      <form @submit.prevent="handleInformationUpdate" class="flex gap-x-4"  >
        <Input placeholder="full name" type="text" v-model="profileData.name" />
        <Input placeholder="email" type="email" v-model="profileData.email"  />
        <FormBtn>update information</FormBtn>
      </form>

    </div>
  </template>