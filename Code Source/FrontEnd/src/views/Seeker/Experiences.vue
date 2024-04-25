<script>
import {reactive} from "vue";
import FormBtn from "@/components/Essential/FormBtn.vue";
import Errors from "@/components/Essential/Errors.vue";
    import Input from "@/components/Essential/Input.vue";
import {
  getExperiences,
  createExperience,
  deleteExperience,
  updateExperience, updateEducations,
} from "../../../functions/Seeker.js";

export default {
      name: "Educations",
      setup() {
        let data = reactive({experiences: [], });
        let errors = reactive({content: [], update: [], });
        let experience = reactive({title: '', location: '', company: '', start_date: '', end_date: '',});
        let experienceForUpdate = reactive({
          id : '',
          index : '',
          data : {
            title: '', location: '', company: '',
          }
        });


        const fetchExperiences = async () => { await getExperiences(data); }; fetchExperiences();
        const handleCreateExperience = async () => { await createExperience(experience, data, errors); }
        const handleDeleteExperience = async (id, index) => { await deleteExperience(data ,id, index); }
        function closePopUp() { document.getElementById('updateExperience').classList.add('hidden');}

        const openUpdatePopUp = async (experience, index) => {
          experienceForUpdate.id = experience.id;
          experienceForUpdate.index = index;
          experienceForUpdate.data.title = experience.title;
          experienceForUpdate.data.location = experience.location;
          experienceForUpdate.data.company = experience.company;
          document.getElementById('updateExperience').classList.remove('hidden');
        }

        const handleUpdateExperience = async () => {
          if (await updateExperience(experienceForUpdate.data, data, errors, experienceForUpdate.id, experienceForUpdate.index)) {
            closePopUp();
          }
        }

        return { data, errors, experience, handleCreateExperience, handleDeleteExperience, experienceForUpdate, closePopUp, openUpdatePopUp, handleUpdateExperience  };
      },
      components: {
        Input, Errors, FormBtn

      },
    }
  </script>

  <template>

    <Errors :data="errors.content" />

    <form class="flex justify-between flex-wrap w-[100%] gap-2 mb-6" @submit.prevent="handleCreateExperience"  >
      <Input type="text" placeholder="job title " input-width="100%" v-model="experience.title" />
      <Input type="text" placeholder="company location" input-width="48%" v-model="experience.location" />
      <Input type="text" placeholder="company name" input-width="48%" v-model="experience.company" />
      <Input type="date"  input-width="48%" v-model="experience.start_date" />
      <Input type="date" input-width="48%" v-model="experience.end_date" />
      <FormBtn>Create a new Education</FormBtn>
    </form>


    <section
        class="hidden w-full h-[100vh] bg-gray-500/80 fixed top-0 right-0 flex justify-center items-center"
        id="updateExperience"
    >
      <div class="w-[50%] bg-white py-6 px-8 rounded border-2 border-gray-800 space-y-6" >
        <Errors :data="errors.update" />
        <FormBtn @click.prevent="closePopUp" type="primary" >Close</FormBtn>
        <form
            class="flex justify-between flex-wrap gap-2 mb-6 "
            @submit.prevent="handleUpdateExperience"
        >
          <Input type="text" placeholder="job title " input-width="100%" v-model="experienceForUpdate.data.title" />
          <Input type="text" placeholder="company location" input-width="48%" v-model="experienceForUpdate.data.location" />
          <Input type="text" placeholder="company name" input-width="48%" v-model="experienceForUpdate.data.company" />
          <FormBtn>Update educations</FormBtn>
        </form>
      </div>
    </section>


    <table class="w-full border-2 border-gray-500" >
      <thead>
      <tr>
        <td class="font-[800]" >index</td>
        <td class="font-[800]" >education data</td>
        <td class="font-[800]" >Other</td>
        <td class="font-[800]" >action</td>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(experience, index) in data.experiences" :key="experience.id" >
        <td><span class="bg-yellow-500 px-2 py-2 rounded" >{{ index + 1 }}</span></td>
        <td>
          <div class="flex flex-col" >
            <span><span class="bg-yellow-500 px-2 rounded" >title :</span> {{ experience.title }} </span>
            <span><span class="bg-yellow-500 px-2 rounded" >location :</span> {{ experience.location }} </span>
            <span><span class="bg-yellow-500 px-2 rounded" >company :</span> {{ experience.company }} </span>
          </div>
        </td>
        <td>
          <div class="flex flex-col" >
            <span><span class="bg-yellow-500 px-2 rounded" >start date :</span> {{ experience.start_date }} </span>
            <span><span class="bg-yellow-500 px-2 rounded" >end date :</span> {{ experience.end_date }} </span>
          </div>
        </td>
        <td>
          <div class="flex gap-x-2" >
            <button @click.prevent="handleDeleteExperience(experience.id, index)" >
              <img src="/icons/delete.png" alt="" class="w-[35px]" >
            </button>
            <button @click.prevent="openUpdatePopUp(experience, index)" >
              <img src="/icons/update.png" alt="" class="w-[35px]" >
            </button>
          </div>
        </td>
      </tr>
      </tbody>
    </table>
  </template>

  <style scoped>
    td {
      border: 2px solid #000;
      padding: 5px 10px 3px 10px;
    }
    thead tr {
      background-color: #000;
      color: #fff;
      font-size: 20px;
    }
    table .role {
      padding: 5px;
      color: white;
    }
  </style>