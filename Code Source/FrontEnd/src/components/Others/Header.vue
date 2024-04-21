
  <script>
    import Button from "@/components/Essential/Button.vue";
    import Logo from "@/components/Essential/Logo.vue";

    export default {
      name: "Header",
      components: {
          Button, Logo,
      },
    }
  </script>

  <template>
    <header class="w-[100%] bg-gray-200 h-[80px]" >
      <div class="w-[85%] h-[100%] m-auto flex justify-between items-center" >

        <Logo link-to="/" icon="logos/logo.png" />

        <nav class="flex gap-x-4" >
          <Button type="third" link-to="/jobs" > jobs </Button>
          <Button type="secondary" link-to="/login" icon="icons/login.png" > login </Button>
          <Button type="primary" link-to="/register" > register </Button>
        </nav>

      </div>
    </header>
  </template>
