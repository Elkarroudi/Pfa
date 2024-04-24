
  <script>
    import Logo from "@/components/Essential/Logo.vue";
    import FormBtn from "@/components/Essential/FormBtn.vue";
    import { deleteCompany, createNewCompany } from "../../../functions/Admin.js";
    import { useRouter } from "vue-router";
    import Input from "@/components/Essential/Input.vue";
    import {reactive} from "vue";
    import Errors from "@/components/Essential/Errors.vue";

    export default {
      name: "Companies",
      props: {
        data: { type: Object, required: true, },
      },
      setup(props) {
        let router = useRouter();
        let errors = reactive({content: [], });
        let formData = reactive({company: new FormData(), });

        const confirmDelete = async (id) => {
          if (confirm("Are you sure you want to delete this company?")) { await deleteCompany(props.data, id); }
        };

        return { confirmDelete, errors };
      },
      data() {
        return {
          company: {name: '', website: '', slogan: null, logo: null, }
        };
      },
      methods: {
        uploadLogo(event) {
          this.company.logo = event.target.files[0];
        },
        uploadSlogan(event) {
          this.company.slogan = event.target.files[0];
        },
        upload() {
          let form = document.getElementById('form');
          console.log(form);
          let formData = new FormData(form);

          console.log(formData);
          console.log(formData.logo);
        }
      },
      components: {Errors, Input, FormBtn, Logo},
    }
  </script>

  <template>
    <Errors :data="errors.content" />

    <form class="flex justify-between flex-wrap w-[100%] gap-2 mb-6" @submit.prevent="upload" enctype="multipart/form-data" id="form" >
      <Input type="text" placeholder="company name" input-width="48%" v-model="company.name" />
      <Input type="text" placeholder="company website" input-width="48%" v-model="company.website" />
      <Input type="file" input-width="48%" @change="uploadLogo" />
      <Input type="file" input-width="48%" @change="uploadSlogan" />
      <FormBtn>Create a new company</FormBtn>
    </form>


    <table class="w-full border-2 border-gray-500" >
      <thead>
      <tr>
        <td class="font-[800]" >index</td>
        <td class="font-[800]" >Logo</td>
        <td class="font-[800]" >company data</td>
        <td class="font-[800]" >action</td>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(company, index) in data" >
        <td><span class="bg-yellow-500 px-2 py-2 rounded" >{{ index + 1 }}</span></td>
        <td>
          <img
              :src="'http://127.0.0.1:8000/storage/' + company.logo"
              :alt="company.name + ' logo'"
              class="w-[150px]"
          >
        </td>
        <td>
          <div class="flex flex-col" >
            <span><span class="bg-yellow-500 px-2 rounded" >name :</span> {{ company.name }}</span>
            <span><span class="bg-yellow-500 px-2 rounded" >website :</span> {{ company.website }}</span>
          </div>
        </td>
        <td>
          <button @click="confirmDelete(company.id)" >
            <img src="/icons/delete.png" alt="" class="w-[35px]" >
          </button>
        </td>
      </tr>
      </tbody>
    </table>
  </template>

  <style>
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
