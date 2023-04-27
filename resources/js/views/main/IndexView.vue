<template>
  <div
    v-if="
      this.$route.path === '/register' ||
      this.$route.path === '/login' ||
      this.$route.path === '/admin'
    "
  ></div>
  <HeaderComponentVue v-else></HeaderComponentVue>

  <router-view></router-view>

  <div
    v-if="
      this.$route.path === '/register' ||
      this.$route.path === '/login' ||
      this.$route.path === '/admin'
    "
  ></div>
  <FooterComponentVue v-else></FooterComponentVue>
</template>
<script lang="ts">
import HeaderComponentVue from "../../components/header_footer/HeaderComponent.vue";
import FooterComponentVue from "../../components/header_footer/FooterComponent.vue";
export default {
  components: { HeaderComponentVue, FooterComponentVue },

  data() {
    return {};
  },

  computed: {
    headerTab() {
      if (this.$route.path === "/register") {
        HeaderComponentVue;
      }
    },
  },
};
</script>
<style lang="css">
@import url("https://fonts.googleapis.com/css2?family=Comfortaa&display=swap"); /* font-family: 'Comfortaa', cursive; */
@import url("https://fonts.googleapis.com/css2?family=Roboto&display=swap"); /* font-family: 'Roboto', sans-serif; */
@import url("https://fonts.googleapis.com/css2?family=Cabin&display=swap"); /* font-family: 'Cabin', sans-serif; */
.bg {
  position: fixed;
  top: 0;
  left: -100%;
  width: 100%;
  height: 130%;
  background: #212529;
}
.translate {
  position: fixed;
  top: 0;
  left: -100%;
  height: 110vh;
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}
.translate img {
  width: 25vw;
}
.translate2 {
  position: fixed;
  top: -50px;
  left: -100%;
  background: transparent;
  height: 110vh;
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}
.translate2 img {
  /* width: ; */
  height: 100vh;
}
@media screen and (max-width: 555px) {
  .translate2 {
    left: -100vh;
  }
}
</style>
