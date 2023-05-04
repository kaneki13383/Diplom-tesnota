<template>
  <body :class="this.$store.state.theme === 'light' ? 'light-theme' : ''">
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
  </body>
</template>
<script lang="ts">
import HeaderComponentVue from "../../components/header_footer/HeaderComponent.vue";
import FooterComponentVue from "../../components/header_footer/FooterComponent.vue";
export default {
  components: { HeaderComponentVue, FooterComponentVue },

  data() {
    return {
      theme: localStorage.getItem("theme"),
    };
  },

  computed: {
    headerTab() {
      if (this.$route.path === "/register") {
        HeaderComponentVue;
      }
    },
  },
  methods: {
    changeTheme() {
      this.$store.state.theme =
        this.$store.state.theme === "dark" ? "light" : "dark";
    },
  },
};
</script>
<style lang="scss">
@import url("https://fonts.googleapis.com/css2?family=Comfortaa&display=swap"); /* font-family: 'Comfortaa', cursive; */
@import url("https://fonts.googleapis.com/css2?family=Roboto&display=swap"); /* font-family: 'Roboto', sans-serif; */
@import url("https://fonts.googleapis.com/css2?family=Cabin&display=swap"); /* font-family: 'Cabin', sans-serif; */
.light-theme {
  transition: 0.5s;
  background: white;
  ul li a {
    color: #212529;
  }
  .cart_count {
    color: white;
  }
  svg g path {
    fill: #212529;
  }
  ul li {
    color: #212529;
  }
  .pagination-page svg g path {
    fill: #af3131;
  }
  .background {
    h1 {
      color: white;
    }
    h3 {
      color: #212529;
    }
    div,
    .links a {
      color: #212529;
    }
  }
  .d-f_sec {
    input[type="text"],
    textarea {
      background: white;
      color: #212529;
    }
    input::placeholder,
    textarea::placeholder {
      color: #212529;
    }
    button {
      color: #212529;
    }
    .text p {
      color: #212529;
    }
  }
  .background_img_text {
    p,
    span {
      color: white;
    }
  }
  .d-f_why_we a {
    color: #212529;
  }
  .search {
    h3 {
      color: #212529;
    }
    input[type="search"] {
      border-color: #212529;
      color: #212529;
    }
  }
  .side_filter h2 {
    color: #212529;
  }
  .alert {
    background: white;
    p {
      color: #000;
    }
  }
  .card {
    background: white;
    color: #212529;
    button {
      color: #212529;
    }
  }
  .adaptive_two {
    button {
      color: #000;
      background: white;
    }
    div {
      color: #000;
      background: white;
    }
  }
  .adaptive_filter {
    h4 {
      color: #000;
    }
    svg path {
      fill: #000;
    }
  }
  .add_comm {
    form {
      textarea {
        background: white;
        color: #000;
      }
      button {
        color: #000;
        background: white;
      }
      button:hover {
        background: #af3131;
      }
    }
  }
  .form {
    background: white;
    div {
      p,
      h1 {
        color: #212529;
      }
    }
    form {
      p {
        color: #212529;
      }
      input {
        color: #212529;
      }
    }
  }
  .adaptive_two {
    h1,
    .price {
      color: #212529;
    }
  }
  .text {
    p {
      color: #212529;
    }
  }
  .discription {
    color: #212529;
  }
  .comments {
    background: white;
    p {
      color: #212529;
    }
    div {
      p {
        color: #212529;
      }
    }
  }
  .no_comm {
    color: #212529;
  }
  .modal {
    background: white;
    label,
    p,
    button {
      color: #000;
    }
  }
  .item {
    p {
      color: #000;
    }
    .delete {
      svg {
        fill: #000;
      }
    }
  }
  .itogo {
    p {
      color: #000;
    }
  }
  .order {
    form {
      button {
        background: white;
        color: #000;
      }
      .check span {
        color: #000;
      }
    }
  }
  .cart_empty {
    h1 {
      color: #000;
    }
  }
  .custom-checkbox:checked + label::before {
    background-color: white;
    background-image: url("./img/галочка — копия.svg");
  }
  .info_data {
    background: rgb(240, 240, 240);
    .background {
      background: white;
      button {
        color: #000;
        background: white;
      }
      button:hover {
        background: #af3131;
      }
      input {
        background: white;
        color: #000;
      }
      input::placeholder {
        color: #000;
      }
    }
  }
  .info_user {
    background: rgb(240, 240, 240);
    p {
      color: #000;
    }
  }
  h2 {
    color: #000;
  }
  .click {
    background: rgb(240, 240, 240);
    p {
      color: #000;
    }
  }
  .active {
    background: rgba(175, 49, 49, 0.58);
  }
  .notFound {
    p {
      color: #000;
    }
  }
  footer ul {
    box-shadow: none;
    border-top: 2px #da3c3c38 solid;
  }
}
</style>
