
  <script>
    import Header from "@/components/Others/Header.vue";

    export default {
      name: "WebLayout",
      components: {
        Header,
      }
    }
  </script>

  <template>
    <Header />
    <slot name="content" />

  </template>