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
import theme from "../theme.vue";
export default {
  components: { HeaderComponentVue, FooterComponentVue, theme },

  data() {
    return {
      theme: "dark",
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
      this.theme = this.theme === "dark" ? "light" : "dark";
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
.toggleWrapper {
  overflow: hidden;
  margin-right: -350px;

  input {
    position: absolute;
    left: -99em;
  }
}

.toggle {
  cursor: pointer;
  display: inline-block;
  position: relative;
  width: 80px;
  height: 40px;
  background-color: #83d8ff;
  border-radius: 90px - 6;
  transition: background-color 200ms cubic-bezier(0.445, 0.05, 0.55, 0.95);

  &:before {
    position: absolute;
    left: -50px;
    top: 15px;
    font-size: 18px;
  }

  &:after {
    position: absolute;
    right: -48px;
    top: 15px;
    font-size: 18px;
    color: #749ed7;
  }
}

.toggle__handler {
  display: inline-block;
  position: relative;
  z-index: 1;
  top: 3px;
  left: 3px;
  width: 40px - 6;
  height: 40px - 6;
  background-color: #ffcf96;
  border-radius: 50px;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
  transition: all 400ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
  transform: rotate(-45deg);

  .crater {
    position: absolute;
    background-color: #e8cda5;
    opacity: 0;
    transition: opacity 200ms ease-in-out;
    border-radius: 100%;
  }

  .crater--1 {
    top: 18px;
    left: 10px;
    width: 4px;
    height: 4px;
  }

  .crater--2 {
    top: 28px;
    left: 22px;
    width: 6px;
    height: 6px;
  }

  .crater--3 {
    top: 10px;
    left: 25px;
    width: 8px;
    height: 8px;
  }
}

.star {
  position: absolute;
  background-color: #ffffff;
  transition: all 300ms cubic-bezier(0.445, 0.05, 0.55, 0.95);
  border-radius: 50%;
}

.star--1 {
  top: 10px;
  left: 35px;
  z-index: 0;
  width: 30px;
  height: 3px;
}

.star--2 {
  top: 18px;
  left: 28px;
  z-index: 1;
  width: 30px;
  height: 3px;
}

.star--3 {
  top: 27px;
  left: 40px;
  z-index: 0;
  width: 30px;
  height: 3px;
}

.star--4,
.star--5,
.star--6 {
  opacity: 0;
  transition: all 300ms 0 cubic-bezier(0.445, 0.05, 0.55, 0.95);
}

.star--4 {
  top: 16px;
  left: 11px;
  z-index: 0;
  width: 2px;
  height: 2px;
  transform: translate3d(3px, 0, 0);
}

.star--5 {
  top: 32px;
  left: 17px;
  z-index: 0;
  width: 3px;
  height: 3px;
  transform: translate3d(3px, 0, 0);
}

.star--6 {
  top: 36px;
  left: 28px;
  z-index: 0;
  width: 2px;
  height: 2px;
  transform: translate3d(3px, 0, 0);
}

input:checked {
  + .toggle {
    background-color: #749dd6;

    &:before {
      color: #749ed7;
    }

    &:after {
      color: #ffffff;
    }

    .toggle__handler {
      background-color: #ffe5b5;
      transform: translate3d(40px, 0, 0) rotate(0);

      .crater {
        opacity: 1;
      }
    }

    .star--1 {
      width: 2px;
      height: 2px;
    }

    .star--2 {
      width: 4px;
      height: 4px;
      transform: translate3d(-5px, 0, 0);
    }

    .star--3 {
      width: 2px;
      height: 2px;
      transform: translate3d(-7px, 0, 0);
    }

    .star--4,
    .star--5,
    .star--6 {
      opacity: 1;
      transform: translate3d(0, 0, 0);
    }
    .star--4 {
      transition: all 300ms 200ms cubic-bezier(0.445, 0.05, 0.55, 0.95);
    }
    .star--5 {
      transition: all 300ms 300ms cubic-bezier(0.445, 0.05, 0.55, 0.95);
    }
    .star--6 {
      transition: all 300ms 400ms cubic-bezier(0.445, 0.05, 0.55, 0.95);
    }
  }
}
</style>
