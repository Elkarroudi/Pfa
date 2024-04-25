
  <script>

    export default {
      name: "Button",
      props: {
        type: { type: String, default: 'primary', },
        linkTo: { type: String, },
        icon: { type: String, },
        variant: { type: String, },
        btnWidth: {type: String, default: '', }
      }
    }
  </script>

  <template>
    <RouterLink
        :to="linkTo"
        :class="{
          'rounded text-lg px-2 py-[3px] md:px-4 md:py-2 flex gap-x-2 items-center' : true,
          'border-2 border-gray-800' :  type !== 'third',
          'text-gray-800 hover:bg-gray-400' :  type === 'secondary',
          'text-white bg-gray-800 hover:bg-gray-600' :  type === 'primary',
          'border-green-700 text-green-700 bg-green-300 hover:bg-green-400 hover:text-white' :  type === 'success',
          'border-red-600 text-red-600 bg-red-200 hover:bg-red-300' :  type === 'warning',

          'flex-col gap-y-[2px]' : variant === 'stacked',
          'flex-row-reverse' : variant === 'reverseIcon',
        }"
        :style="{ width: btnWidth }"
    >
        <img v-if="icon" :src="icon" alt="Button Icon" class="h-[28px]" >
        <slot />
    </RouterLink>
  </template>