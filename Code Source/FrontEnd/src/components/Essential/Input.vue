
  <script>

    export default {
      name: "Input",
      props: {
        type: {type: String, default: 'text', },
        placeholder: {type: String, },
        modelValue: {type: String, default: '', },
        inputWidth: {type: String, default: '', },
        name: {type: String, default: '', }
      },
    }
  </script>

  <template>
    <input
        :type="type"
        :placeholder="placeholder"
        :value="modelValue"
        :name="name"
        @input="$emit('update:modelValue', $event.target.value)"
        class="border-2 border-gray-800 px-4 py-2 outline-0 rounded"
        :style="{ width: inputWidth }"
    />
  </template>