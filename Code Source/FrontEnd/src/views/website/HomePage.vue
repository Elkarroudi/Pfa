
  <script>
    import WebLayout from "@/components/Layouts/WebLayout.vue";
    import Button from "@/components/Essential/Button.vue";
    import { reactive } from "vue";

    export default {
      name: "HomePage",
      setup() {
        let data = reactive({companies: []});

        const fetchCompanies = async () => {
          try {
            const response = await fetch('http://127.0.0.1:8000/api/v1/public/company/all/', {
              method: 'GET',
            }).then(response => response.json());
            data.companies = response.data;
          } catch (error) { throw new Error('Error Fetching Companies Data !'); }
        };
        fetchCompanies();

        return { fetchCompanies, data, };
      },
      components: {
        WebLayout, Button,
      },
    }
  </script>

  <template>
    <WebLayout>
      <template v-slot:content >
        <section class="bg-red-50 flex flex-col justify-center items-center" style="min-height: calc(100vh - 80px);" >

          <div class="w-[80%] mx-auto" >
            <h1 class="text-center text-[30px] md:text-[50px] font-[900] mb-2" >find jobs in morocco</h1>
            <p class="text-center text-[16px] md:text-[25px] px-[40px] mb-4" >
              when you’re searching for a job or a new career opportunity, there are a few things you can do to get the most out of your search
            </p>
          </div>

          <section class="bg-gray-200 w-full py-8 flex items-center justify-center gap-x-4" >
            <div class="w-[50%] flex gap-x-4" >
              <div  v-for="company in data.companies" :key="company.id" >
                <a :href="company.website" :title="'Company Name :' + company.name" >
                  <img
                      class="h-[40px]"
                      :src="'http://127.0.0.1:8000/storage/' + company.logo" :alt="company.name + 'logo'"
                  >
                </a>
              </div>
            </div>
            <Button type="secondary" icon="icons/arrow.png" variant="reverseIcon" ></Button>
          </section>

          <div class="flex justify-center gap-x-2 mt-4" >
            <Button link-to="/jobs" type="primary" >jobs</Button>
            <Button link-to="/jobs" type="secondary" >create your account</Button>
          </div>

        </section>
      </template>
    </WebLayout>
  </template>