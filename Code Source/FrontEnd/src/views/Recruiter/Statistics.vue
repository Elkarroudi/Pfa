
  <script>
    import {reactive} from "vue";
    import { getStatistics } from "../../../functions/Recruiter.js";

    export default {
      name: "Statistics",
      setup() {
        let data = reactive({statistics: [], });

        const fetch = async ()  => {
          await getStatistics(data);
        };
        fetch();

        return {data, }
      },
    }
  </script>

  <template>
    <div class="flex flex-wrap mt-10 gap-y-4 gap-x-[calc(20%/4)]">
      <div
          style="width: 21%;"
          v-for="(statistic, index) in data.statistics"
          :key="`statistic-index-${index}`"
          :class="{
              'rounded border-2 border-gray-800 px-4 py-4 flex items-center justify-center flex-col bg-gray-200' : true,
            }"
      >
        <span class="font-[800] text-2xl" >{{ statistic }} +</span>
        <h1 class="font-[600] text-xl" >{{ index}}</h1>
      </div>
    </div>
  </template>