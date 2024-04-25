
  <script>
    import {reactive} from "vue";
    import { getEducations, createEducations, deleteEducations, updateEducations,  } from "../../../functions/Seeker.js";
    import FormBtn from "@/components/Essential/FormBtn.vue";
    import Errors from "@/components/Essential/Errors.vue";
    import Input from "@/components/Essential/Input.vue";
    import {updateListing} from "../../../functions/Recruiter.js";

    export default {
      name: "Educations",
      setup() {
        let data = reactive({educations: [], });
        let errors = reactive({content: [], update: [], });
        let education = reactive({university: '', field_of_study: '', start_date: '', graduation_date: '',});
        let educationForUpdate = reactive({
          id : '',
          index : '',
          data : {
            university: '', field_of_study: '',
          }
        });


        const fetchEducation = async () => { await getEducations(data); }; fetchEducation();
        const handleCreateEducation = async () => { await createEducations(education, data, errors); }
        const handleDeleteEducation = async (id, index) => { await deleteEducations(data, id, index); }
        function closePopUp() { document.getElementById('updateEducation').classList.add('hidden');}

        const openUpdatePopUp = async (education, index) => {
          educationForUpdate.id = education.id;
          educationForUpdate.index = index;
          educationForUpdate.data.university = education.university;
          educationForUpdate.data.field_of_study = education.field_of_study;
          document.getElementById('updateEducation').classList.remove('hidden');
        }
        const handleUpdateEducation = async () => {
          if (await updateEducations(educationForUpdate.data, data, errors, educationForUpdate.id, educationForUpdate.index)) {
            closePopUp();
          }
        }


        return { data, errors, education, handleCreateEducation, handleDeleteEducation, closePopUp, educationForUpdate, openUpdatePopUp, handleUpdateEducation, };
      },
      components: {
        Input, Errors, FormBtn

      },
    }
  </script>

  <template>

    <Errors :data="errors.content" />

    <form class="flex justify-between flex-wrap w-[100%] gap-2 mb-6" @submit.prevent="handleCreateEducation"  >
      <Input type="text" placeholder="university name" input-width="48%" v-model="education.university" />
      <Input type="text" placeholder="field of study" input-width="48%" v-model="education.field_of_study" />
      <Input type="date"  input-width="48%" v-model="education.start_date" />
      <Input type="date" input-width="48%" v-model="education.graduation_date" />
      <FormBtn>Create a new Education</FormBtn>
    </form>


    <section
        class="hidden w-full h-[100vh] bg-gray-500/80 fixed top-0 right-0 flex justify-center items-center"
        id="updateEducation"
    >
      <div class="w-[50%] bg-white py-6 px-8 rounded border-2 border-gray-800 space-y-6" >
        <Errors :data="errors.update" />
        <FormBtn @click.prevent="closePopUp" type="primary" >Close</FormBtn>
        <form
            class="flex justify-between flex-wrap gap-2 mb-6 "
            @submit.prevent="handleUpdateEducation"
        >
          <Input type="text" placeholder="university name" input-width="48%" v-model="educationForUpdate.data.university" />
          <Input type="text" placeholder="field of study" input-width="48%" v-model="educationForUpdate.data.field_of_study" />
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
      <tr v-for="(education, index) in data.educations" :key="education.id" >
        <td><span class="bg-yellow-500 px-2 py-2 rounded" >{{ index + 1 }}</span></td>
        <td>
          <div class="flex flex-col" >
            <span><span class="bg-yellow-500 px-2 rounded" >university :</span> {{ education.university }} </span>
            <span><span class="bg-yellow-500 px-2 rounded" >field of study :</span> {{ education.field_of_study }} </span>
          </div>
        </td>
        <td>
          <div class="flex flex-col" >
            <span><span class="bg-yellow-500 px-2 rounded" >start date :</span> {{ education.start_date }} </span>
            <span><span class="bg-yellow-500 px-2 rounded" >graduation date :</span> {{ education.graduation_date }} </span>
          </div>
        </td>
        <td>
          <div class="flex gap-x-2" >
            <button @click.prevent="handleDeleteEducation(education.id, index)" >
              <img src="/icons/delete.png" alt="" class="w-[35px]" >
            </button>
            <button @click.prevent="openUpdatePopUp(education, index)" >
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