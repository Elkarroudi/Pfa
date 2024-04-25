<script>
import {reactive} from "vue";
import WebLayout from "@/components/Layouts/WebLayout.vue";
import {getListingData} from "../../../functions/Website.js";
import {addBookmark, addApplications, } from "../../../functions/Seeker.js";
    import {useRoute, useRouter} from "vue-router";
    import Button from "@/components/Essential/Button.vue";

    export default {
      name: "JobDetail",
      setup() {
        let route = useRoute();
        let router = useRouter();
        let errors = reactive({content: [], });
        let data = reactive({listing: [], });

        const fetchListingData = async () => {
          if (!await getListingData(data, route.params.id)) {
            await router.push('/notFound');
          }
        };
        fetchListingData();

        const handleBookmark = async (id) => {
          await addBookmark(id);
        };
        const handleApplication = async (id) => {
          await addApplications(id);
        };

        return { errors, data, handleBookmark, handleApplication, };
      },
      components: {
        Button,
        WebLayout,
      }
    }
  </script>

  <template>
    <WebLayout >
      <template v-slot:content>
        <main class="w-[85%] m-auto pt-[100px] flex justify-between flex-wrap gap-4" >

          <section class="w-[100%] md:w-[70%] bg-gray-200 px-4 py-6 rounded border-2 border-gray-500" >
            <div class="flex  items-center justify-between " >
              <div class="flex items-center justify-center bg-gray-100 w-[20%] rounded h-[150px]" >
                <img :src="'http://127.0.0.1:8000/storage/' + data.listing[0].company.logo" alt="icon" class="w-[50px] md:w-[110px]" >
              </div>
              <div class="w-[75%] flex justify-between items-center" >
                <div>
                  <h1>
                    <a class="font-[800] text-lg md:text-xl" :href="data.listing[0].company.website" >{{ data.listing[0].company.name }}</a>
                  </h1>
                  <h1 class="font-[700]  text-lg md:text-2xl"  >{{  data.listing[0].title }}<span class="hidden md:block" > ( {{  data.listing[0].salary }} dh )</span></h1>
                  <div class="flex gap-x-4 items-center mt-[10px]" >
                    <span class="flex gap-x-2 items-center" > <img src="/icons/location.png" alt="icon" class="w-[30px]" > {{ data.listing[0].location }}</span>
                    <span class="flex gap-x-2 items-center" > <img src="/icons/type.png" alt="icon" class="w-[30px]" > {{data.listing[0].employment_type }}</span>
                  </div>
                </div>
                <span class="hidden md:flex gap-x-2 items-centers" >
                  <form @submit.prevent="handleBookmark(data.listing[0].id)" >
                    <button class="bg-gray-100 border-2 border-gray-500 rounded p-2 hover:bg-gray-300" >
                      <img src="/icons/bookmark.png" alt="icon" class="w-[40px]" >
                    </button>
                  </form>

                  <form @submit.prevent="handleApplication(data.listing[0].id)" >
                    <button class="bg-gray-100 border-2 border-gray-500 rounded p-2 hover:bg-gray-300" >
                      <img src="/icons/apply.png" alt="icon" class="w-[40px]" >
                    </button>
                  </form>
                </span>
              </div>
            </div>

            <h1 class="font-[700] text-2xl mt-4" >job description :</h1>
              <div class="text-justify text-xl">
                <span class="bg-yellow-500 px-2 rounded" >title :</span>
                {{  data.listing[0].title }}
              </div>
              <div class="text-justify text-xl" ><span class="bg-yellow-500 px-2 rounded" >overview :</span> {{  data.listing[0].overview }}</div>
              <div class="text-justify text-xl"><span class="bg-yellow-500 px-2 rounded" >responsibilities :</span> {{  data.listing[0].responsibilities }}</div>
              <div class="text-justify text-xl"><span class="bg-yellow-500 px-2 rounded" >requirements :</span> {{  data.listing[0].requirements }}</div>
              <div class="text-justify text-xl"><span class="bg-yellow-500 px-2 rounded" >requirements :</span> {{  data.listing[0].requirements }}</div>
              <div class="text-justify text-xl"><span class="bg-yellow-500 px-2 rounded" >salary :</span> {{  data.listing[0].salary }}</div>
          </section>

          <section class="w-[100%] md:w-[25%] bg-gray-200 px-4 py-6 rounded border-2 border-gray-500" >
            <div>
              <h1 class="font-[700] text-xl" >recruiter :</h1>
              <div class="flex flex-col mt-2 mb-4" >
                <span><span class="bg-yellow-500 px-2 rounded" >name :</span> {{  data.listing[0].recruiter.user.name  }}</span>
                <span><span class="bg-yellow-500 px-2 rounded" >name :</span> {{  data.listing[0].recruiter.user.email }}</span>
              </div>

              <h1 class="font-[700] text-xl mt-4" >total number of applications :</h1>
              <span><span class="bg-yellow-500 px-2 rounded" >total number :</span> {{  data.listing[0].applications.length  }}</span>

              <div class="flex flex-col mt-2 mb-4" >
                <h1 class="font-[700] text-xl mt-4" >other informations :</h1>
                <span><span class="bg-yellow-500 px-2 rounded" >post date :</span> {{  data.listing[0].post_date }}</span>
                <span><span class="bg-yellow-500 px-2 rounded" >expirations date :</span> {{  data.listing[0].expiration_date  }}</span>
                <span><span class="bg-yellow-500 px-2 rounded" >salary :</span> {{  data.listing[0].salary  }}</span>
                <span><span class="bg-yellow-500 px-2 rounded" >company related :</span> {{  data.listing[0].company.name  }}</span>
              </div>

            </div>
          </section>

        </main>
      </template>
    </WebLayout>
  </template>