
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
    <main
        class="w-[85%] m-auto flex justify-between items-center"
        style="min-height: calc(100vh - 100px);"
    >
      <slot name="content" />
    </main>
  </template>