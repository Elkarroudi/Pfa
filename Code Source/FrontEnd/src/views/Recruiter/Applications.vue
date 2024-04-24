  <script>
    import FormBtn from "@/components/Essential/FormBtn.vue";
    import Errors from "@/components/Essential/Errors.vue";
    import Input from "@/components/Essential/Input.vue";
    import {useRouter} from "vue-router";
    import {reactive} from "vue";
    import {changeStatus, getApplications} from "../../../functions/Recruiter.js";

    export default {
      name: "Applications",
      components: {FormBtn, Errors, Input},
      setup () {
        let router = useRouter();
        let errors = reactive({content: [], });
        let data = reactive({ applications: [], applicationsFrom: 'All', applicationToShow: [], });

        const getData = async () => { await getApplications(data);  }; getData();
        const select = (event) => {
          data.applicationsFrom = event.target.value;
          if (data.applicationsFrom !== 'All' ) {
            data.applicationToShow = data.applications.listings.filter(listing => listing.id === data.applicationsFrom)
          }
        };

        const changeApplicantStatus = async (status, id) => { await changeStatus(status, id, data.applications.listings);  };


        return { data, errors, select, changeApplicantStatus,  };
      }
    }

  </script>

  <template>
     <section>
       <div class="flex flex-col" >
         <span><span class="bg-yellow-500 px-2 rounded" >your listing count :</span> {{ data.applications.listings_count }}</span>
         <div class="space-x-4" >
           <span class="bg-yellow-500 px-2 rounded" >select a job post to display applicant :</span>
           <select @change="select" v-model="data.applicationsFrom" class="border-2 border-gray-800 px-4 outline-0 rounded" >
             <option selected value="All" >show application from all jobs</option>
             <option v-for="listing in data.applications.listings" :key="listing.id" :value="listing.id">
               {{ listing.title }}
             </option>
           </select>
         </div>
       </div>

      <div
          v-if="data.applicationToShow !== []"
          v-for="listing in data.applicationToShow"
          class="mt-6 w-[100%] space-y-2"
      >
        <div
            v-if="listing.applications.length"
            v-for="applications in listing.applications"
            class="flex w-full bg-gray-200 px-4 py-4 rounded border-2 border-gray-800 items-center gap-x-[100px]"
        >
          <div class="flex flex-col" >
            <span><span class="bg-yellow-500 px-2 rounded" >applicant name :</span> {{ applications.job_seeker.user.name }}</span>
            <span><span class="bg-yellow-500 px-2 rounded" >applicant email :</span> {{ applications.job_seeker.user.email }}</span>
            <span><span class="bg-yellow-500 px-2 rounded" >username :</span> {{ applications.job_seeker.user.username }}</span>
          </div>

          <div class="flex flex-col">
            <span><span class="bg-yellow-500 px-2 rounded" >applying date :</span> {{ applications.date }}</span>
            <span class="space-x-2" >
              <span class="bg-yellow-500 px-2 rounded" >status :</span>
              <span v-if="applications.status === 'Pending'" class="bg-orange-500 text-white px-2 rounded" > {{ applications.status.toLowerCase() }}</span>
              <span v-if="applications.status === 'Approved'" class="bg-green-500 px-2 rounded text-white" > {{ applications.status.toLowerCase() }}</span>
              <span v-if="applications.status === 'Refused'" class="bg-red-500 px-2 rounded text-white" > {{ applications.status.toLowerCase() }}</span>
            </span>
          </div>

          <div class="flex gap-x-2" >
            <button @click.prevent="changeApplicantStatus('Approved', applications.id)" > <img src="/icons/approve.png" alt="" class="w-[35px]" > </button>
            <button @click.prevent="changeApplicantStatus('Refused', applications.id)" > <img src="/icons/reject.png" alt="" class="w-[35px]" > </button>
          </div>

        </div>

        <div
            v-else
            class="bg-red-200 px-4 py-2 rounded border-2 border-red-500 font-[500] text-xl"
        >there is no application yet in this listing !</div>
      </div>

       <div v-else >
         please choose a job to start seeing application !
       </div>

     </section>
  </template>