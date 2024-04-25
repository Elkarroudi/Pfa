<script>

import {reactive} from "vue";
import {getApplications, deleteApplication} from "../../../functions/Seeker.js";

export default {
  name: "Applications",
  setup() {
        let data = reactive({applications: [], });

        const fetchApplications = async () => {
          await getApplications(data);
        }
        fetchApplications();

        const handleDeleteApplication = async (id, index) => {
          await deleteApplication(data, id, index);
        }
        return {data, handleDeleteApplication};
      },
    }
  </script>

  <template>

    <section class="space-y-2">
      <div
          v-for="(application, index) in data.applications"
          class="flex w-full bg-gray-200 px-4 py-4 rounded border-2 border-gray-800 items-center gap-x-[100px]"
      >
        <div class="flex flex-col min-w-[20%]" >
          <span><span class="bg-yellow-500 px-2 rounded" >job title :</span> {{ application.listing.title }}</span>
          <span><span class="bg-yellow-500 px-2 rounded" >job location :</span> {{ application.listing.location }}</span>
          <span><span class="bg-yellow-500 px-2 rounded" >job employment type :</span> {{ application.listing.employment_type }}</span>
          <span><span class="bg-yellow-500 px-2 rounded" >job salary :</span> {{ application.listing.salary }}</span>
        </div>

        <div class="flex flex-col">
          <span><span class="bg-yellow-500 px-2 rounded" >applying date :</span> {{ application.date }}</span>
          <span class="space-x-2" >
              <span class="bg-yellow-500 px-2 rounded" >status :</span>
              <span v-if="application.status === 'Pending'" class="bg-orange-500 text-white px-2 rounded" > {{ application.status.toLowerCase() }}</span>
              <span v-if="application.status === 'Approved'" class="bg-green-500 px-2 rounded text-white" > {{ application.status.toLowerCase() }}</span>
              <span v-if="application.status === 'Refused'" class="bg-red-500 px-2 rounded text-white" > {{ application.status.toLowerCase() }}</span>
            </span>
        </div>

        <div class="flex gap-x-2" >
          <button @click.prevent="handleDeleteApplication(application.id, index)" > <img src="/icons/delete.png" alt="" class="w-[35px]" > </button>
        </div>

      </div>
    </section>

  </template>