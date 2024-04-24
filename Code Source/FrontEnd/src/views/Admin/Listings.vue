
  <script>
    import {reactive} from "vue";
    import { getListing, changeStatus } from "../../../functions/Admin.js";

    export default {
      name: "Listings",
      setup() {
        let data = reactive({ content: [], });

        const fetchListing = async () => {
          await getListing(data);
        }
        fetchListing();

        const handleChangesStatus = async (status, id, index) => {
          await changeStatus(status, id, index, data.content);
        }

        return { data, handleChangesStatus,  };
      }
    }
  </script>

  <template>
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
            </span>        </td>
        <td>
          <div class="flex gap-x-2" >
            <button @click.prevent="handleChangesStatus('Approved', listing.id, index)" >
              <img src="/icons/approve.png" alt="" class="w-[35px]" >
            </button>
            <button @click.prevent="handleChangesStatus('Refused', listing.id, index)" >
              <img src="/icons/reject.png" alt="" class="w-[35px]" >
            </button>
          </div>
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