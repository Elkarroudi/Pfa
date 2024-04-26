
  <script>
    import WebLayout from "@/components/Layouts/WebLayout.vue";
    import Button from "@/components/Essential/Button.vue";
    import Errors from "@/components/Essential/Errors.vue";
    import { getListings, searchJObs, getCompanies, } from "../../../functions/Website.js";
    import {reactive} from "vue";
    import Input from "@/components/Essential/Input.vue";
    import FormBtn from "@/components/Essential/FormBtn.vue";

    export default {
      name: "Jobs",
      setup() {
        let data = reactive({listings: [], companies: [],  });
        let errors = reactive({content: [], filter: [], });
        let search = reactive({query: '', location: '', });

        const fetchData = async () => {
          await getListings(data);
          await getCompanies(data);
        }; fetchData();

        const handleSearch = async () => {
          await searchJObs(search, data);
        };

        const handleFilter = async () => {
          await searchJObs(search, data);
          hideFilterPopUp();
        };

        function hideFilterPopUp () { document.getElementById('filterListings').classList.add('hidden'); }
        function openFilterPopUp () { document.getElementById('filterListings').classList.remove('hidden'); }


        return {data, handleSearch, search, errors, openFilterPopUp, hideFilterPopUp, handleFilter,  };
      },
      components: {
        FormBtn, Input, Button, WebLayout, Errors,
      }
    }
  </script>

  <template>
    <WebLayout>
      <template v-slot:content >
        <section class="w-[85%] m-auto pt-[100px]" >

          <section class="w-[100%] mb-8"  >
            <Errors :data="errors.content" />
            <div class="w-[100%] flex justify-between" >
              <button
                  class="w-[12%] flex gap-x-2 items-center text-xl font-[600] bg-gray-200 border-2 border-gray-800 rounded px-4 py-2 hover:bg-gray-300"
                  @click.prevent="openFilterPopUp"
              >
                <img src="/icons/filter.png" alt="" class="w-[35px]" > <span class="hidden md:block" >filter</span>
              </button>
              <form class="w-[85%] flex gap-x-4" @submit.prevent="handleSearch"  >
                <Input placeholder="Search A job by title" input-width="100%" v-model="search.query" />
                <FormBtn >Search</FormBtn>
              </form>
            </div>
          </section>

          <section
              class="hidden w-full h-[100vh] bg-gray-500/80 fixed top-0 right-0 flex justify-center items-center"
              id="filterListings"
          >
            <div class="w-[80%] md:w-[50%] bg-white py-[40px] px-8 rounded border-2 border-gray-800 space-y-6" >
              <FormBtn @click.prevent="hideFilterPopUp" type="secondary" >Close</FormBtn>
              <form
                  class="flex flex-col gap-y-2"
                  @submit.prevent="handleFilter"
              >
                <h1 class="font-[800] text-2xl" >filter jobs</h1>
                <Input type="text" placeholder="filter by location" v-model="search.location" />
                <FormBtn >Apply Filter</FormBtn>
              </form>
            </div>
          </section>

          <section class="w-[100%] flex-wrap flex justify-between gap-4" >
            <div
                v-if="data.listings.length"
                v-for="listing in data.listings"
                :key="`listings_${listing.id}`"
                class="bg-gray-200 px-6 py-4 w-[100%] md:w-[48%] h-[200px] rounded  border-gray-600 border-2 hover:bg-gray-300/70 hover:border-[3px] hover:border-r-[10px] "
            >
              <RouterLink :to="`/jobs/`+ listing.id + '/'" class="flex items-center justify-between h-[100%]" >
                <div class="flex items-center justify-center bg-gray-100 w-[20%] rounded h-[100%]" >
                  <img :src="'http://127.0.0.1:8000/storage/' + listing.company.slogan" alt="icon" class="w-[50px] md:w-[110px] rounded" >
                </div>
                <div class="w-[75%] flex justify-between items-center" >
                  <div>
                    <h1>
                      <a class="font-[800] text-lg md:text-xl" :href="listing.company.website" >{{ listing.company.name }}</a>
                    </h1>
                    <h1 class="font-[700]  text-lg md:text-2xl"  >{{  listing.title }}<span class="hidden md:block" > ( {{  listing.salary }} dh )</span></h1>
                    <div class="flex gap-x-4 items-center mt-[10px]" >
                      <span class="flex gap-x-2 items-center" > <img src="/icons/location.png" alt="icon" class="w-[30px]" > {{ listing.location }}</span>
                      <span class="flex gap-x-2 items-center" > <img src="/icons/type.png" alt="icon" class="w-[30px]" > {{listing.employment_type }}</span>
                    </div>
                  </div>
                  <span class="hidden md:block" >
                  <Button icon="/icons/right-arrow.png" type="secondary" :link-to="`/jobs/`+ listing.id + '/'" ></Button>
                </span>

                </div>
              </RouterLink>
            </div>
            <h1 class="font-[800] text-2xl w-[100%] px-6 py-4 rounded bg-red-300 text-red-500 border-2 border-red-500" v-else >
              listings not found, or empty, we are sorry !
            </h1>
          </section>
        </section>
      </template>
    </WebLayout>
  </template>