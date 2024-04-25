<script>
import {getBookmark, deleteBookmark} from "../../../functions/Seeker.js";
import {reactive} from "vue";
import Button from "@/components/Essential/Button.vue";
import FormBtn from "@/components/Essential/FormBtn.vue";

export default {
  name: "Bookmark",
      setup() {
        let data = reactive({bookmarks: [], });

        const fetchBookmarks = async () => {
          await getBookmark(data);
        }
        fetchBookmarks();

        const handleDelete = async (index, id) => {
          await deleteBookmark(data, id, index);
        }

        return { data, handleDelete,  };
      },
      components: {
        FormBtn,
        Button

      },

    }
  </script>

  <template>
    <section  >
      <div v-if="data.bookmarks.length" class="flex gap-y-4 flex-wrap justify-between" >
        <div
            class="flex items-center space-y-4 justify-between h-[100%] bg-gray-200 px-6 py-4 w-[100%] md:w-[48%] h-[200px] rounded  border-gray-600 border-2 hover:bg-gray-300/70 hover:border-[3px] hover:border-r-[10px] "
            v-for="(bookmark, index) in data.bookmarks"
            :key="bookmark.id"
        >
            <div class="flex items-center justify-center bg-gray-100 w-[20%] rounded h-[100%]" >
              <img :src="'http://127.0.0.1:8000/storage/' + bookmark.listing.company.logo" alt="icon" class="w-[50px] md:w-[110px]" >
            </div>
            <div class="w-[75%] flex justify-between items-center" >
              <div>
                <h1>
                  <a class="font-[800] text-lg md:text-xl" :href="bookmark.listing.company.website" >{{ bookmark.listing.company.name }}</a>
                </h1>
                <h1 class="font-[700]  text-lg md:text-2xl"  >{{  bookmark.listing.title }}<span class="hidden md:block" > ( {{  bookmark.listing.salary }} dh )</span></h1>
                <div class="flex gap-x-4 items-center mt-[10px]" >
                  <span class="flex gap-x-2 items-center" > <img src="/icons/location.png" alt="icon" class="w-[30px]" > {{ bookmark.listing.location }}</span>
                  <span class="flex gap-x-2 items-center" > <img src="/icons/type.png" alt="icon" class="w-[30px]" > {{bookmark.listing.employment_type }}</span>
                </div>
              </div>
              <span class="hidden md:block" >
                  <form @submit.prevent="handleDelete(index, bookmark.id)" >
                    <button class="bg-red-100 border-2 border-red-500 rounded p-2 hover:bg-red-300" >
                      <img src="/icons/delete.png" alt="icon" class="w-[40px]" >
                    </button>
                  </form>
              </span>
            </div>
        </div>

      </div>
      <div v-else >
        <h1 class="font-[800] text-2xl w-[100%] px-6 py-4 rounded bg-red-300 text-red-500 border-2 border-red-500"  >
          no bookmark were found, we are sorry !
        </h1>
      </div>
    </section>
  </template>

  <style>

  </style>