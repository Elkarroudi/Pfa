
  <script>
    import { reactive } from "vue";

    export default {
      name: "Success",
      props: {
        msgToExpect: { required: true, }
      },
      setup() {
        let msg = reactive({availability: true});
        setTimeout(() => { msg.availability = false;}, 4000);

        return { msg, };
      },
    }
  </script>

  <template>
    <section class="fixed bottom-0 right-0 mr-4 mb-6 md:w-1/4" >
      <div
          v-if="msgToExpect && msg.availability"
          class="bg-green-100 border-2 border-green-700 rounded text-green-700 flex flex-col gap-x-8"
      >
        <div class="w-[100%] h-[3px] bg-[#cccccc]">
          <div
              class="h-[100%] bg-green-700"
              style="animation: progress 4s linear forwards;"
          ></div>
        </div>
        <div class="flex items-center px-6 py-4 gap-x-4" >
          <img src="/icons/check.png" alt="warning" class="w-[40px]"  >
          {{ msgToExpect.toLowerCase() }}
        </div>
      </div>
    </section>
  </template>

  <style>

  @keyframes progress {
    0% { width: 0%; }
    100% { width: 100%; }
  }
  </style>