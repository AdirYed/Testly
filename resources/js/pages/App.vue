<template>
  <div>
    <testly-header />

    <router-view :key="$route.fullPath" class="container tw-pb-8 md:tw-pb-10" />

    <testly-footer />
  </div>
</template>

<script>
import Header from "../components/Header";
import Footer from "../components/Footer";

export default {
  name: "app",

  components: {
    "testly-header": Header,
    "testly-footer": Footer
  }
};
</script>
