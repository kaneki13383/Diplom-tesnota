<template>
  <div class="all">
    <div class="side_filter" v-show="show == true">
      <h2>Фильтры</h2>
      <div class="d-f gap">
        <div class="d-f">
          <div>
            <div class="filter">
              <p>Виды</p>
            </div>
          </div>
          <div class="last_active">
            <div v-if="load2 == true">
              <div class="active_loading"></div>
              <div class="active_loading"></div>
              <div class="active_loading"></div>
            </div>

            <div
              v-for="typ in types"
              :key="typ"
              @click="
                sort_on.includes(typ.type) ? {} : this.sort_on.push(typ.type)
              "
              class="active"
            >
              <p>{{ typ.type }}</p>
            </div>
          </div>
        </div>
        <div class="d-f">
          <div>
            <div class="filter">
              <p>Цена</p>
            </div>
          </div>
          <div class="last_active">
            <div class="active">
              <div class="range-slider">
                <span @change="slider"
                  ><p>От</p>
                  <input
                    v-model.number="minPrice"
                    type="number"
                    :min="min"
                    :max="max"
                  />
                  <p>До</p>
                  <input
                    v-model.number="maxPrice"
                    type="number"
                    :min="min"
                    :max="max"
                  />
                </span>
                <input
                  @change="slider"
                  v-model.number="minPrice"
                  :min="min"
                  :max="max"
                  step="1"
                  type="range"
                  class="slider"
                />
                <input
                  @change="slider"
                  v-model.number="maxPrice"
                  :min="min"
                  :max="max"
                  step="1"
                  type="range"
                  class="slider"
                />
                <!-- <svg width="100%" height="24"></svg> -->
              </div>
            </div>
          </div>
        </div>
        <div
          class="active"
          @click="clearFilter()"
          v-if="filteredList.length != 0 || sort_on != ''"
        >
          Очистить фильтры
        </div>
      </div>
      <button
        class="apply_filter"
        @click="show = false"
        v-show="mobile == true"
      >
        Применить фильтры
      </button>
    </div>
    <div class="adaptive" style="width: 70%">
      <p class="pagination">
        <router-link to="/"> Главная </router-link> / Меню
      </p>
      <div class="search">
        <h3>Меню</h3>
        <input type="search" placeholder="Поиск" v-model="search" />
      </div>
      <div v-if="sort_on != ''" class="d-f-2">
        <div class="last_active">
          <div
            class="active"
            v-for="(active, index) in sort_on"
            :key="active"
            @click="sort_on.splice(index, 1)"
          >
            <p>{{ active }}</p>
            <p>X</p>
          </div>
        </div>
      </div>
      <div class="adaptive_filter">
        <h4>Меню</h4>
        <!-- <img
          @click="show = true"
          src="../../../../public/img/Vector.svg"
          alt=""
        /> -->
        <svg
          @click="show = true"
          width="35"
          height="35"
          viewBox="0 0 35 35"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M0.465408 3.52188C4.90826 9.1875 13.1121 19.6875 13.1121 19.6875V32.8125C13.1121 34.0156 14.1019 35 15.3116 35H19.7104C20.9201 35 21.9099 34.0156 21.9099 32.8125V19.6875C21.9099 19.6875 30.0917 9.1875 34.5346 3.52188C35.6563 2.07813 34.6226 0 32.797 0H2.20296C0.377431 0 -0.656302 2.07813 0.465408 3.52188Z"
            fill="white"
          />
        </svg>
      </div>
      <div class="products_df d-n" v-show="sort_on == ''">
        <div
          class="fulfilling-bouncing-circle-spinner margin"
          v-if="load == true"
        >
          <div class="circle"></div>
          <div class="orbit"></div>
        </div>
        <div v-for="product in menu" :key="product">
          <router-link :to="{ path: '/product/' + product.id }">
            <div class="card">
              <img class="img" :src="product.images[0].img" alt="" />
              <p class="name">{{ product.name }}</p>
              <p class="price" v-if="active_promo">
                Цена:
                {{ product.price - product.price * 0.15 }} ₽
              </p>
              <p class="price" v-else>Цена: {{ product.price }} ₽</p>
              <button
                v-if="token"
                @click.prevent="
                  addCart(product.id),
                    this.countCart(),
                    accessMessage(product.name)
                "
              >
                Купить
              </button>
            </div>
          </router-link>
        </div>
      </div>

      <div class="products_df love">
        <div
          class="notFound"
          v-if="
            filteredList.length == 0 &&
            (dn == 'none' || op != 1) &&
            load != true
          "
        >
          <p>Ничего не найдено</p>
        </div>
        <div v-for="product in filteredList" :key="product">
          <router-link :to="{ path: '/product/' + product.id }">
            <div class="card">
              <img class="img" :src="product.images[0].img" alt="" />
              <p class="name">{{ product.name }}</p>
              <p class="price" v-if="active_promo">
                Цена:
                {{ product.price - product.price * 0.15 }} ₽
              </p>
              <p class="price" v-else>Цена: {{ product.price }} ₽</p>
              <button
                v-if="token"
                @click.prevent="
                  addCart(product.id),
                    this.countCart(),
                    accessMessage(product.name)
                "
              >
                Купить
              </button>
            </div>
          </router-link>
        </div>
      </div>
      <div class="pagination-page" v-show="sort_on == ''">
        <router-link
          v-for="link in pagination.links"
          :key="link"
          :to="
            link.url == null
              ? {
                  name: 'catalog',
                  params: { page: pagination.current_page },
                }
              : { name: 'catalog', params: { page: link.url } }
          "
          v-html="link.label"
        ></router-link>
      </div>
    </div>
    <transition mode="out-in">
      <div class="alert" v-show="alert == true">
        <div @click="alert = false">X</div>
        <p>{{ message }}</p>
      </div>
    </transition>
  </div>
</template>

<script>
import StyleComponent from "../StyleComponent.vue";
import "vue3-carousel/dist/carousel.css";
import { Carousel, Slide, Pagination, Navigation } from "vue3-carousel";
export default {
  components: {
    Carousel,
    Slide,
    Pagination,
    Navigation,
    StyleComponent,
  },
  data() {
    return {
      dn: "",
      op: "",
      minPrice: 0,
      maxPrice: 0,
      max: 0,
      min: 0,
      menu: [],
      all_menu: [],
      price: [],
      token: localStorage.getItem("x_xsrf_token"),
      types: [],
      sort_on: [],
      active_promo: localStorage.getItem("active_promo"),
      cart_coun: 0,
      alert: false,
      message: "",
      counter: 1,
      show: false,
      mobile: false,
      notFound: false,
      load: true,
      load2: true,
      page: this.$route.params["page"],
      pagination: {},
      search: "",
    };
  },
  mounted() {
    this.allMenu();
    this.allMenu2();
    this.AllTypes();
    if (window.innerWidth > 1023) {
      this.show = true;
      this.mobile = false;
    } else {
      this.show = false;
      this.mobile = true;
    }
    // console.log();
  },
  computed: {
    filteredList() {
      let sort = this.sort_on;
      const min_const = this.min;
      const max_const = this.max;
      let min = this.minPrice;
      let max = this.maxPrice;
      let search = this.search;
      return this.all_menu.filter(function (elem) {
        let name_product = elem.name;
        name_product = name_product.toLowerCase();
        let result = search.toLocaleLowerCase();
        if (sort == "") {
          if (max_const == max && min_const == min) {
            document.querySelector(".products_df.d-n").style.opacity = 1;
            document.querySelector(".d-n").style.position = "relative";
            document.querySelector(".pagination-page").style.opacity = 1;
            document.querySelector(".pagination-page").style.position =
              "relative";
            if (search != "") {
              document.querySelector(".d-n").style.opacity = 0;
              document.querySelector(".d-n").style.position = "absolute";
              document.querySelector(".pagination-page").style.opacity = 0;
              document.querySelector(".pagination-page").style.position =
                "absolute";
              return name_product.indexOf(result) > -1;
            }
            document.querySelector(".products_df.d-n").style.opacity = 1;
            document.querySelector(".d-n").style.position = "relative";
            document.querySelector(".pagination-page").style.opacity = 1;
            document.querySelector(".pagination-page").style.position =
              "relative";
            return false;
          }
          document.querySelector(".d-n").style.opacity = 0;
          document.querySelector(".d-n").style.position = "absolute";
          document.querySelector(".pagination-page").style.opacity = 0;
          document.querySelector(".pagination-page").style.position =
            "absolute";

          return (
            elem.price >= min &&
            elem.price <= max &&
            name_product.indexOf(result) > -1
          );
        } else if (sort != "") {
          return (
            sort.includes(elem.type.type) &&
            elem.price >= min &&
            elem.price <= max &&
            name_product.indexOf(result) > -1
          );
        }
      });
    },
  },
  watch: {
    $route() {
      this.page = this.$route.params.page;
      this.loading = true;
      this.allMenu();
    },
  },
  updated() {
    this.dn = document.querySelector(".d-n").style.display;
    this.op = document.querySelector(".d-n").style.opacity;
  },
  methods: {
    noneMenu() {
      for (let index = 0; index < this.menu.length; index++) {
        if (
          (this.sort_on.includes(this.menu[index]["type"].type) != true &&
            this.menu[index].price >= this.minPrice) ||
          this.menu[index].price <= this.maxPrice ||
          (this.sort_on.includes(this.menu[index]["type"].type) == "" &&
            this.menu[index].price >= this.minPrice) ||
          this.menu[index].price <= this.maxPrice
        ) {
          this.notFound = false;
        } else if (
          this.sort_on.includes(this.menu[index]["type"].type) == true &&
          this.menu[index].price >= this.minPrice
        ) {
          this.notFound = true;
        }
      }
    },
    accessMessage(name) {
      this.alert = true;
      this.message = "Товар " + name + " добавлен в корзину";
      setTimeout(() => {
        this.alert = false;
      }, 4000);
    },
    countCart() {
      if (this.token) {
        this.cart_count = 0;
        axios.get("/api/cart/all").then((res) => {
          for (let index = 0; index < res.data.data.length; index++) {
            this.cart_count += res.data.data[index].count;
          }
          this.$store.state.user.cart_count = this.cart_count;
        });
      }
    },
    slider: function () {
      if (this.minPrice > this.maxPrice) {
        let tmp = this.maxPrice;
        this.maxPrice = this.minPrice;
        this.minPrice = tmp;
      }
    },
    allMenu2() {
      axios.get("/api/admin/catalog").then((res) => {
        this.all_menu = res.data.data;
        // console.log(this.all_menu);

        for (let index = 0; index < this.all_menu.length; index++) {
          this.price.push(this.all_menu[index]["price"]);
        }
        this.minPrice = Math.min.apply(null, this.price);
        this.maxPrice = Math.max.apply(null, this.price);
        this.max = Math.max.apply(null, this.price);
        this.min = Math.min.apply(null, this.price);

        // let arr_leght = this.all_menu.length - 1;

        // console.log(this.all_menu.length - arr_leght);
      });
    },
    allMenu() {
      axios
        .get(`/api/catalog?page=${this.page}`)
        .then((response) => {
          // console.log(response.data);
          this.menu = response.data.products;
          // console.log(this.menu);
          this.pagination = this.changeUrl(response.data.content);
        })
        .finally(() => {
          this.loading = false;
          this.load = false;
        });
    },
    changeUrl(arr) {
      let num_arr = arr.links.length - 1;
      let svg_left = `<svg fill="#af3131" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="30px" height="30px" viewBox="0 0 314.069 314.069" style="enable-background:new 0 0 314.069 314.069;"
	 xml:space="preserve">
<g>
	<g id="_x34_97._Back">
		<g>
			<path d="M293.004,78.525C249.648,3.436,153.62-22.295,78.531,21.061C3.436,64.411-22.296,160.443,21.068,235.542
				c43.35,75.087,139.375,100.822,214.465,57.467C310.629,249.648,336.365,153.621,293.004,78.525z M219.836,265.802
				c-60.075,34.685-136.894,14.114-171.576-45.969C13.57,159.762,34.155,82.936,94.232,48.253
				c60.071-34.683,136.894-14.099,171.578,45.979C300.495,154.308,279.908,231.118,219.836,265.802z M187.645,101.528
				c-6.136-6.133-16.078-6.133-22.205,0l-44.406,44.4c-6.129,6.131-6.129,16.078,0,22.213l44.406,44.402
				c6.127,6.128,16.069,6.128,22.205,0c6.132-6.131,6.123-16.077,0-22.201l-33.308-33.302l33.308-33.315
				C193.777,117.587,193.785,107.649,187.645,101.528z"/>
		</g>
	</g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
</svg>`;
      let svg_right = `<svg fill="#af3131" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="30px" height="30px" viewBox="0 0 314.069 314.069" style="enable-background:new 0 0 314.069 314.069;"
	 xml:space="preserve">
<g>
	<g id="_x34_97._Back">
		<g>
			<path d="M293.004,78.525C249.648,3.436,153.62-22.295,78.531,21.061C3.436,64.411-22.296,160.443,21.068,235.542
				c43.35,75.087,139.375,100.822,214.465,57.467C310.629,249.648,336.365,153.621,293.004,78.525z M219.836,265.802
				c-60.075,34.685-136.894,14.114-171.576-45.969C13.57,159.762,34.155,82.936,94.232,48.253
				c60.071-34.683,136.894-14.099,171.578,45.979C300.495,154.308,279.908,231.118,219.836,265.802z M187.645,101.528
				c-6.136-6.133-16.078-6.133-22.205,0l-44.406,44.4c-6.129,6.131-6.129,16.078,0,22.213l44.406,44.402
				c6.127,6.128,16.069,6.128,22.205,0c6.132-6.131,6.123-16.077,0-22.201l-33.308-33.302l33.308-33.315
				C193.777,117.587,193.785,107.649,187.645,101.528z"/>
		</g>
	</g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
</svg>`;
      arr.links[num_arr].label = svg_right;
      arr.links[0].label = svg_left;
      arr.links.forEach((link, index) => {
        link.url = this.parseUrl(link);
      });
      return arr;
    },
    parseUrl(link) {
      if (link.url != null) {
        let url = new URL(link.url);
        return url.searchParams.get("page");
      }
      return this.page;
    },
    AllTypes() {
      axios.get("/api/type_all").then((res) => {
        this.types = res.data;
        this.load2 = false;
      });
    },
    addCart(id) {
      axios.post(`/api/cart/${id}`, { counter: this.counter });
    },
    clearFilter() {
      (this.sort_on = []), (this.minPrice = this.min);
      this.maxPrice = this.max;
    },
  },
};
</script>

<style lang="scss" scoped>
.active_loading {
  background: linear-gradient(
    110deg,
    rgba(175, 49, 49, 0.58) 8%,
    #9e3b3b 18%,
    rgba(175, 49, 49, 0.58) 33%
  );
  border-radius: 5px;
  width: 270px;
  height: 50px;
  background-size: 200% 100%;
  border-bottom: 1px white solid;
  animation: 1s shine linear infinite;
}
@keyframes shine {
  to {
    background-position-x: -200%;
  }
}
.search {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
}
.search input[type="search"] {
  height: 44px;
  width: 350px;
  background: transparent;
  border: white 2px solid;
  border-radius: 13px;
  color: white;
  font-family: "Comfortaa", cursive;
  padding-left: 10px;
  margin-right: 3vw;
}
.pagination-page {
  width: 330px;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  gap: 20px;
  margin: 0 auto;
  margin-bottom: 50px;
}
.pagination-page a:last-child {
  rotate: 180deg;
}
.pagination-page a:not(:first-child, :last-child) {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 50px;
  height: 50px;
  border: 1px solid #af3131;
  border-radius: 8px;
  background: transparent;
  font-family: "Roboto";
  font-style: normal;
  font-weight: 400;
  font-size: 22px;
  color: #af3131;
}
.pagination-page a:not(:first-child, :last-child).router-link-active {
  background: #af3131;
  border: 1px solid #6b1f1f;
  color: #000;
}
.fulfilling-bouncing-circle-spinner,
.fulfilling-bouncing-circle-spinner * {
  box-sizing: border-box;
}

.fulfilling-bouncing-circle-spinner {
  height: 60px;
  width: 60px;
  position: relative;
  left: 30vw;
  top: 15vh;
  margin-bottom: 33.5vh;
  animation: fulfilling-bouncing-circle-spinner-animation infinite 4000ms ease;
  display: flex;
}

.fulfilling-bouncing-circle-spinner .orbit {
  height: 60px;
  width: 60px;
  position: absolute;
  top: 0;
  left: 0;
  border-radius: 50%;
  border: calc(60px * 0.03) solid #c22020;
  animation: fulfilling-bouncing-circle-spinner-orbit-animation infinite 4000ms
    ease;
}

.fulfilling-bouncing-circle-spinner .circle {
  height: 60px;
  width: 60px;
  color: #c22020;
  display: block;
  border-radius: 50%;
  position: relative;
  border: calc(60px * 0.1) solid #c22020;
  animation: fulfilling-bouncing-circle-spinner-circle-animation infinite 4000ms
    ease;
  transform: rotate(0deg) scale(1);
}

@keyframes fulfilling-bouncing-circle-spinner-animation {
  0% {
    transform: rotate(0deg);
  }

  100% {
    transform: rotate(360deg);
  }
}

@keyframes fulfilling-bouncing-circle-spinner-orbit-animation {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(1);
  }
  62.5% {
    transform: scale(0.8);
  }
  75% {
    transform: scale(1);
  }
  87.5% {
    transform: scale(0.8);
  }
  100% {
    transform: scale(1);
  }
}

@keyframes fulfilling-bouncing-circle-spinner-circle-animation {
  0% {
    transform: scale(1);
    border-color: transparent;
    border-top-color: inherit;
  }
  16.7% {
    border-color: transparent;
    border-top-color: initial;
    border-right-color: initial;
  }
  33.4% {
    border-color: transparent;
    border-top-color: inherit;
    border-right-color: inherit;
    border-bottom-color: inherit;
  }
  50% {
    border-color: inherit;
    transform: scale(1);
  }
  62.5% {
    border-color: inherit;
    transform: scale(1.4);
  }
  75% {
    border-color: inherit;
    transform: scale(1);
    opacity: 1;
  }
  87.5% {
    border-color: inherit;
    transform: scale(1.4);
  }
  100% {
    border-color: transparent;
    border-top-color: inherit;
    transform: scale(1);
  }
}
.filter {
  color: white;
  font-family: "Comfortaa", serif;
  font-size: 30px;
  width: 270px;
  height: 50px;
  background: #212529;
  display: flex;
  justify-content: center;
  align-items: center;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}
.d-f-2 .last_active {
  display: flex;
  flex-direction: row;
  gap: 5px;
}

.d-f-2 .last_active .active,
.d-f-2 .last_active {
  border: none;
  border-radius: 11px;
  height: 40px;
  width: auto;
  margin-bottom: 20px;
  overflow-y: hidden;
}

.d-f-2 .last_active .active {
  padding: 0 10px;
}

.d-f-2 .last_active p:last-child {
  margin-left: 10px;
}

.d-f {
  display: flex;
  flex-direction: column;
  gap: 5px;
}

.d-f .d-f:nth-child(2) .last_active {
  height: 117px;
}

.d-f .d-f:nth-child(2) .active {
  height: 100%;
}

.gap {
  gap: 10px;
}
.last_active {
  height: 152px;
  overflow-x: auto;
}
.last_active::-webkit-scrollbar {
  width: 10px; /* ширина scrollbar */
}
.last_active::-webkit-scrollbar-track {
  background: #1d2023; /* цвет дорожки */
}
.last_active::-webkit-scrollbar-thumb {
  background-color: #af3131; /* цвет плашки */
  border-radius: 50px; /* закругления плашки */
  border: 10px solid #af3131;
}
.last_active :last-child {
  border-bottom: none;
  border-bottom-left-radius: 10px;
  border-bottom-right-radius: 10px;
}
.notFound {
  color: white;
  font-size: 30px;
  font-family: "Comfortaa", serif;
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 50vh;
}
.adaptive_filter {
  display: none;
}
.alert {
  position: fixed;
  z-index: 10;
  color: white;
  background: #1d2023;
  border: 2px solid #af3131;
  margin-left: 74%;
  margin-top: 35%;
  font-family: "Comfortaa", serif;
  p {
    padding: 2vw 1vw;
  }
  .link {
    color: #af3131;
  }
  div {
    float: right;
    margin-top: 10px;
    margin-right: 10px;
    color: #af3131;
    cursor: pointer;
  }
}
.warning {
  color: white;
  font-family: "Comfortaa", serif;
  margin: 14vw;
}
.side_filter {
  position: fixed;
  left: 100px;
}
.products_df {
  display: flex;
  flex-wrap: wrap;
  gap: 5vw;
  margin-bottom: 5vh;
}
.pagination,
a {
  color: #af3131;
  font-size: 18px;
  font-family: "Comfortaa", serif;
  margin-top: 30px;
}
.card {
  width: 350px;
  height: 400px;
  background: #1d2023;
  border: 2px solid #af3131;
  border-radius: 10px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 1.4vw;
  color: white;
  transition: 0.5s;
  cursor: pointer;
}
.card:hover {
  box-shadow: 8px 7px 20px #af3131;
}
.card p {
  font-size: 17px;
}
.card .name {
  text-align: center;
}
.card .price {
  font-size: 25px;
}
.card button {
  width: 240px;
  height: 40px;
  background: transparent;
  border: 2px solid #af3131;
  color: white;
  border-radius: 7px;
  cursor: pointer;
  transition: 0.5s;
}
.card button:hover {
  background: #af3131;
  color: #1d2023;
  font-weight: bold;
}
.card .img {
  width: 240px;
  height: 180px;
  border-radius: 5px;
}
.all {
  display: flex;
  flex-direction: row;
  justify-content: space-around;
}
input[type="number"] {
  border: none;
  color: white;
  text-align: center;
  font-size: 1.2vw;
  background: transparent;
}

input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
  -webkit-appearance: none;
}

input[type="number"]:invalid,
input[type="number"]:out-of-range {
  border: 2px solid #ff6347;
}
.range-slider {
  width: 90%;
  margin: auto;
  text-align: center;
  position: relative;
  height: 6em;
}
.range-slider input[type="range"] {
  position: absolute;
  left: 0;
  top: 70px;
}
input[type="range"] {
  width: 100%;
  color: #af3131;
  -webkit-appearance: none;
}
input[type="range"]::-webkit-slider-runnable-track {
  width: 100%;
  height: 3px;
  cursor: pointer;
  animation: 0.2s;
  background: #ffff;
  border-radius: 1px;
  box-shadow: none;
  border: 0;
}
input[type="range"]::-webkit-slider-thumb {
  z-index: 2;
  position: relative;
  height: 15px;
  width: 15px;
  border-radius: 50%;
  background: #ffffff;
  cursor: pointer;
  -webkit-appearance: none;
  margin-top: -6px;
}
input[type="range"]::-moz-range-track {
  width: 100%;
  height: 3px;
  cursor: pointer;
  animation: 0.2s;
  background: #3faffa;
  border-radius: 1px;
  box-shadow: none;
  border: 0;
}
input[type="range"]::-moz-range-thumb {
  z-index: 2;
  position: relative;
  box-shadow: 0px 0px 0px #000;
  border: 1px solid #2497e3;
  height: 18px;
  width: 18px;
  border-radius: 50%;
  background: #3faffa;
  cursor: pointer;
}
input[type="range"]::-ms-track {
  width: 100%;
  height: 5px;
  cursor: pointer;
  animation: 0.2s;
  background: transparent;
  border-color: transparent;
  color: transparent;
}
input[type="range"]::-ms-fill-lower,
input[type="range"]::-ms-fill-upper {
  background: #3faffa;
  border-radius: 1px;
  box-shadow: none;
  border: 0;
}
input[type="range"]::-ms-thumb {
  z-index: 2;
  position: relative;
  height: 18px;
  width: 18px;
  border-radius: 50%;
  background: #3faffa;
  cursor: pointer;
}
span p {
  margin-top: 3px;
}
span {
  display: flex;
  margin-top: 20px;
}
h2 {
  color: white;
  font-family: "Comfortaa", serif;
  font-size: 40px;
  margin-top: 100px;
  margin-bottom: 40px;
}
h3 {
  color: white;
  font-family: "Comfortaa", serif;
  font-size: 40px;
  margin-top: 50px;
  margin-bottom: 40px;
}
.filter {
  color: white;
  font-family: "Comfortaa", serif;
  font-size: 30px;
  width: 270px;
  height: 50px;
  background: rgb(22, 24, 27, 100%);
  display: flex;
  justify-content: center;
  align-items: center;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}
.active {
  color: white;
  font-family: "Comfortaa", serif;
  font-size: 30px;
  width: 270px;
  height: 50px;
  display: flex;
  justify-content: space-around;
  align-items: center;
  background: rgb(175, 49, 49, 58%);
  font-size: 18px;
  border-bottom: 1px white solid;
  cursor: pointer;
}
.d-f {
  display: flex;
  flex-direction: column;
  gap: 5px;
}
.d-f .d-f:nth-child(2) .last_active {
  height: 117px;
}
.d-f .d-f:nth-child(2) .active {
  height: 100%;
}
.gap {
  gap: 10px;
}
.last_active :last-child {
  border-bottom: none;
  border-bottom-left-radius: 10px;
  border-bottom-right-radius: 10px;
}
.adaptive {
  margin-left: 20vw;
}
@media screen and (max-width: 1720px) {
  .products_df {
    padding-left: 10vw;
    justify-content: center;
  }
  .search {
    justify-content: space-evenly;
  }
}
@media screen and (max-width: 1023px) {
  h3 {
    display: none;
  }
  .products_df {
    padding-left: 0vw;
  }
  .search {
    justify-content: center;
    margin-top: 5vh;
  }
  .fulfilling-bouncing-circle-spinner {
    left: 0vw;
  }
  .d-f-2 {
    margin-top: 5vw;
    margin-bottom: 0vw;
  }
  .side_filter {
    z-index: 2;
  }
  input[type="number"] {
    font-size: 18px;
  }
  .adaptive_filter {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    h4 {
      color: white;
      font-family: "Comfortaa", serif;
      font-size: 40px;
      margin-top: 50px;
      margin-bottom: 40px;
    }
    svg {
      padding-top: 5vh;
    }
  }
  .products_df {
    align-items: center;
    justify-content: center;
    z-index: 1;
  }
  .adaptive {
    margin-left: 5vw;
  }
  .side_filter {
    background: #0000009d;
    width: 100%;
    height: 100vh;
    left: 0;
    top: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    overflow-y: hidden;
    .apply_filter {
      background: #af3131;
      color: white;
      border: none;
      font-size: 15px;
      font-family: "Comfortaa", serif;
      padding: 15px;
      border-radius: 7px;
      margin-top: 4vw;
    }
  }
}
</style>
