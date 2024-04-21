
  <script>
    export default {
      name: "Input",
      props: {
        type: {type: String, default: 'text', },
        placeholder: {type: String, },
        value: {type: String, },
      }
    }
  </script>

  <template>
    <input
        :type="type"
        :placeholder="placeholder"
        :value="value"
        class="border-2 border-gray-800 px-4 py-2 outline-0"
    >
    </input>
  </template>