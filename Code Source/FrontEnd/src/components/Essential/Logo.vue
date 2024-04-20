
  <script>

    export default {
      name: "Logo",
      props: {
        linkTo: { type: String, required: true, },
        icon: { type: String, }
      },
    }
  </script>

  <template>
    <RouterLink
        :to="linkTo"
    >
      <img :src="icon" alt="Logo" class="h-[30px]" >
    </RouterLink>
  </template>
