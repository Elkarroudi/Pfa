  <script>
    export default {
      name: "FormBtn",
      props: {
        type: { type: String, default: 'primary', },
        variant: { type: String, },
      }
    }
  </script>

  <template>
    <button
      :class="{
          'text-lg px-2 py-[3px] md:px-4 md:py-2 flex gap-x-2 items-center rounded' : true,
          'border-2 border-gray-800' :  type !== 'third',
          'text-gray-800 hover:bg-gray-400' :  type === 'secondary',
          'text-white bg-gray-800 hover:bg-gray-600' :  type === 'primary',
          'border-green-700 text-green-700 bg-green-300 hover:bg-green-400 hover:text-white' :  type === 'success',
          'border-red-700 text-red-700 bg-red-300 hover:bg-red-400 hover:text-white' :  type === 'warning',

          'flex-col gap-y-[2px]' : variant === 'stacked',
          'flex-row-reverse' : variant === 'reverseIcon',
        }"
    >
      <slot />
    </button>
  </template>