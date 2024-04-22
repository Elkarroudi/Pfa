
  <script>
    export default {
      name: "Errors",
      props: {
        data: {type: [Array, String], default: []}
      }
    }
  </script>

  <template>
    <div class="bg-red-200 border-2 border-red-700 px-6 py-4 mb-4 rounded text-red-700 flex items-center gap-x-8 mt-6" v-if="data.length" >
      <img src="/icons/warning.png" alt="warning" class="w-[40px]"  >
      <div>
        <p
            v-if="data === 'Unauthorized'"
        >- {{ data.toLowerCase() }}</p>

        <p
            v-else
            v-for="error in data"
        >- {{ error.toLowerCase() }}</p>
      </div>
    </div>
  </template>