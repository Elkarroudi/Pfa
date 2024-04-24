  <script>
    import {reactive} from "vue";
    import {getRecruiterListings, deleteListing, getCompanies, createNewListing, updateListing } from "../../../functions/Recruiter.js";
    import Input from "@/components/Essential/Input.vue";
    import Errors from "@/components/Essential/Errors.vue";
    import FormBtn from "@/components/Essential/FormBtn.vue";

    export default {
      name: "Listings",
      components: {FormBtn, Errors, Input},
      setup () {
        let errors = reactive({content: [], });
        let updateErrors = reactive({content: [], });
        let data = reactive({ content: [], companies: [], });
        let listing = reactive({
          company_id: '', title: '', overview: '', requirements: '', responsibilities: '', location: '',  salary: '',  employment_type: '',  post_date: '',  expiration_date: '',
        });

        let listingForUpdate = reactive({
          id : '',
          index : '',
          data : {
            title: '', overview: '', requirements: '', responsibilities: '', location: '',  salary: '',  employment_type: '',  expiration_date: '',
          }
        });

        const getData = async () => { await getRecruiterListings(data); await getCompanies(data); }; getData();
        const selectCompany = (event) => { listing.company_id = event.target.value; };
        const deleteList = async (id) => { if (confirm("Are you sure you want to delete this listing?")) {await deleteListing(data.content, id)} };
        const handleAdd = async () => { await createNewListing(errors, listing, data.content); };

        const openUpdatePopUp = async (listing, index) => {
          listingForUpdate.id = listing.id;
          listingForUpdate.index = index;
          listingForUpdate.data.title = listing.title;
          listingForUpdate.data.overview = listing.overview;
          listingForUpdate.data.responsibilities = listing.responsibilities;
          listingForUpdate.data.requirements = listing.requirements;
          listingForUpdate.data.location = listing.location;
          listingForUpdate.data.salary = listing.salary;
          listingForUpdate.data.employment_type = listing.employment_type;
          listingForUpdate.data.post_date = listing.post_date;
          listingForUpdate.data.expiration_date = listing.expiration_date;
          document.getElementById('updateListing').classList.remove('hidden');
        }

        const handleUpdate = async () => {
          if (await updateListing(updateErrors, listingForUpdate.data, listingForUpdate.id, data.content, listingForUpdate.index)) {
            document.getElementById('updateListing').classList.add('hidden');
          }
        }
        function closePopUp() { document.getElementById('updateListing').classList.add('hidden');}

        return { data, deleteList, listing, errors, handleAdd, selectCompany, openUpdatePopUp, closePopUp, handleUpdate, listingForUpdate, updateErrors };
      }
    }
  </script>

  <template>

    <Errors :data="errors.content" />

    <form class="flex justify-between flex-wrap w-[100%] gap-2 mb-6" @submit.prevent="handleAdd" enctype="multipart/form-data" id="form" >
      <Input type="text" placeholder="company name" input-width="48%" v-model="listing.title" />
      <select v-model="listing.company_id" @change="selectCompany" @select="listing.company_id" class="border-2 border-gray-800 px-4 py-2 outline-0 rounded w-[48%]"  >
        <option selected value="" >Select Job Related Company</option>
        <option v-for="company in data.companies" :key="company.id" :value="company.id" >{{ company.name }}</option>
      </select>
      <Input type="text" placeholder="overview" input-width="48%" v-model="listing.overview" />
      <Input type="text" placeholder="responsibilities" input-width="48%" v-model="listing.responsibilities" />
      <Input type="text" placeholder="responsibilities" input-width="48%" v-model="listing.requirements" />
      <Input type="text" placeholder="location" input-width="48%" v-model="listing.location" />
      <Input type="number" placeholder="salary" input-width="48%" v-model="listing.salary" />
      <Input type="text" placeholder="contract type" input-width="48%" v-model="listing.employment_type" />
      <Input type="date" placeholder="post date" input-width="48%" v-model="listing.post_date" />
      <Input type="date" placeholder="expiration name" input-width="48%" v-model="listing.expiration_date" />
      <FormBtn>Create a new listing</FormBtn>
    </form>

    <section
        class="hidden w-full h-[100vh] bg-gray-500/80 fixed top-0 right-0 flex justify-center items-center"
        id="updateListing"
    >
      <div class="w-[50%] bg-white py-6 px-8 rounded border-2 border-gray-800 space-y-6" >
        <FormBtn @click.prevent="closePopUp" type="primary" >Close</FormBtn>
        <Errors :data="updateErrors.content" />
        <form
            class="flex justify-between flex-wrap gap-2 mb-6 "
            @submit.prevent="handleUpdate"
        >
          <Input type="text" id="title" placeholder="company name" input-width="48%" v-model="listingForUpdate.data.title" />
          <Input type="text" placeholder="responsibilities" input-width="48%" v-model="listingForUpdate.data.responsibilities" />
          <Input type="text" placeholder="overview" input-width="100%" v-model="listingForUpdate.data.overview" />
          <Input type="text" placeholder="responsibilities" input-width="48%" v-model="listingForUpdate.data.requirements" />
          <Input type="text" placeholder="location" input-width="48%" v-model="listingForUpdate.data.location" />
          <Input type="number" placeholder="salary" input-width="48%" v-model="listingForUpdate.data.salary" />
          <Input type="text" placeholder="contract type" input-width="48%" v-model="listingForUpdate.data.employment_type" />
          <FormBtn >update listing</FormBtn>
        </form>
      </div>
    </section>


    <table class="w-full border-2 border-gray-500" >
      <thead>
      <tr>
        <td class="font-[800]" >index</td>
        <td class="font-[800]" >Listing data</td>
        <td class="font-[800]" >Other</td>
        <td class="font-[800]" >Status</td>
        <td class="font-[800]" >action</td>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(listing, index) in data.content" >
        <td><span class="bg-yellow-500 px-2 py-2 rounded" >{{ index + 1 }}</span></td>
        <td>
          <div class="flex flex-col" >
            <span><span class="bg-yellow-500 px-2 rounded" >name :</span> {{ listing.title }}</span>
            <span><span class="bg-yellow-500 px-2 rounded" >location :</span> {{ listing.location }}</span>
            <span><span class="bg-yellow-500 px-2 rounded" >salary :</span> {{ listing.salary }} Dh</span>
            <span><span class="bg-yellow-500 px-2 rounded" >contract type :</span> {{ listing.employment_type }}</span>
          </div>
        </td>
        <td>
          <div class="flex flex-col" >
            <span><span class="bg-yellow-500 px-2 rounded" >post date :</span> {{ listing.post_date }} Dh</span>
            <span><span class="bg-yellow-500 px-2 rounded" >expiration date :</span> {{ listing.expiration_date }}</span>
          </div>
        </td>
        <td>
          <span class="space-x-2" >
              <span class="bg-yellow-500 px-2 rounded" >status :</span>
              <span v-if="listing.status === 'Pending'" class="bg-orange-500 text-white px-2 rounded" > {{ listing.status.toLowerCase() }}</span>
              <span v-if="listing.status === 'Approved'" class="bg-green-500 px-2 rounded text-white" > {{ listing.status.toLowerCase() }}</span>
              <span v-if="listing.status === 'Refused'" class="bg-red-500 px-2 rounded text-white" > {{ listing.status.toLowerCase() }}</span>
            </span>
        </td>
        <td>
          <div class="flex gap-x-2" >
            <button @click.prevent="deleteList(listing.id)" >
              <img src="/icons/delete.png" alt="" class="w-[35px]" >
            </button>
            <button @click.prevent="openUpdatePopUp(listing, index)" >
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