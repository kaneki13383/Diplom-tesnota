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
                        <div
                            v-for="typ in types"
                            :key="typ"
                            @click="
                                sort_on.includes(typ.type)
                                    ? {}
                                    : this.sort_on.push(typ.type)
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
                                        :min="80"
                                        :max="max"
                                    />
                                    <p>До</p>
                                    <input
                                        v-model.number="maxPrice"
                                        type="number"
                                        :min="80"
                                        :max="max"
                                    />
                                </span>
                                <input
                                    @change="slider"
                                    v-model.number="minPrice"
                                    :min="80"
                                    :max="max"
                                    step="1"
                                    type="range"
                                    class="slider"
                                />
                                <input
                                    @change="slider"
                                    v-model.number="maxPrice"
                                    :min="minPrice"
                                    :max="max"
                                    step="1"
                                    type="range"
                                    class="slider"
                                />
                                <svg width="100%" height="24"></svg>
                            </div>
                        </div>
                    </div>
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
                <router-link to="/"> Главная </router-link> / О нас
            </p>
            <h3>Меню</h3>
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
                <img
                    @click="show = true"
                    src="../../../../public/img/Vector.svg"
                    alt=""
                />
            </div>
            <div class="products_df">
                <div class="fulfilling-bouncing-circle-spinner" v-if="load == true">
                    <div class="circle"></div>
                    <div class="orbit"></div>
                </div>
                <div v-for="product in menu" :key="product" ref="element">
                    <router-link
                        :to="{ path: '/product/' + product.id }"
                        v-if="
                            (product.price >= minPrice &&
                                product.price <= maxPrice &&
                                sort_on == '') ||
                            (product.price >= minPrice &&
                                product.price <= maxPrice &&
                                sort_on.includes(product.type.type))
                        "
                    >
                        <div class="card">
                            <img
                                class="img"
                                :src="product.images[0].img"
                                alt=""
                            />
                            <p class="name">{{ product.name }}</p>
                            <p class="price" v-if="active_promo">
                                Цена:
                                {{ product.price - product.price * 0.15 }} ₽
                            </p>
                            <p class="price" v-else>
                                Цена: {{ product.price }} ₽
                            </p>
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
            <p v-if="notFound == true" class="notFound">Ничего не найдено</p>
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
    setup() {},
    data() {
        return {
            minPrice: 0,
            maxPrice: 0,
            max: 0,
            menu: [],
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
            load: true
        };
    },
    mounted() {
        this.allMenu();
        this.AllTypes();
        if (window.innerWidth > 1600) {
            this.show = true;
            this.mobile = false;
        } else {
            this.show = false;
            this.mobile = true;
        }
        this.noneMenu();
    },
    methods: {
        noneMenu() {
            for (let index = 0; index < this.menu.length; index++) {
                if (
                    (this.sort_on.includes(this.menu[index]["type"].type) !=
                        true &&
                        this.menu[index].price >= this.minPrice) ||
                    this.menu[index].price <= this.maxPrice ||
                    (this.sort_on.includes(this.menu[index]["type"].type) ==
                        "" &&
                        this.menu[index].price >= this.minPrice) ||
                    this.menu[index].price <= this.maxPrice
                ) {
                    this.notFound = false;
                } else if (
                    this.sort_on.includes(this.menu[index]["type"].type) ==
                        true &&
                    this.menu[index].price >= this.minPrice
                ) {
                    this.notFound = true;
                }
            }
        },
        accessMessage(name) {
            this.alert = true;
            this.message = "Товар " + name + " добавлен в корзину";
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
        allMenu() {
            axios.get("/api/menu_all").then((res) => {
                this.menu = res.data.data;

                for (let index = 0; index < this.menu.length; index++) {
                    this.price.push(this.menu[index]["price"]);
                }
                this.minPrice = Math.min.apply(null, this.price);
                this.maxPrice = Math.max.apply(null, this.price);
                this.max = Math.max.apply(null, this.price);
                this.load = false
            });
        },
        AllTypes() {
            axios.get("/api/type_all").then((res) => {
                this.types = res.data;
            });
        },
        addCart(id) {
            axios.post(`/api/cart/${id}`, { counter: this.counter });
        },
    },
};
</script>

<style lang="scss" scoped>
.fulfilling-bouncing-circle-spinner, .fulfilling-bouncing-circle-spinner * {
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
    }

    .fulfilling-bouncing-circle-spinner .orbit {
      height: 60px;
      width: 60px;
      position: absolute;
      top: 0;
      left: 0;
      border-radius: 50%;
      border: calc(60px * 0.03) solid #c22020;
      animation: fulfilling-bouncing-circle-spinner-orbit-animation infinite 4000ms ease;
    }

    .fulfilling-bouncing-circle-spinner .circle {
      height: 60px;
      width: 60px;
      color: #c22020;
      display: block;
      border-radius: 50%;
      position: relative;
      border: calc(60px * 0.1) solid #c22020;
      animation: fulfilling-bouncing-circle-spinner-circle-animation infinite 4000ms ease;
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

.active {
    color: white;
    font-family: "Comfortaa", serif;
    font-size: 30px;
    width: 270px;
    height: 50px;
    display: flex;
    justify-content: space-around;
    align-items: center;
    background: #ad9562;
    font-size: 18px;
    border-bottom: 1px white solid;
    cursor: pointer;
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

.last_active :last-child {
    border-bottom: none;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
}
.notFound {
    color: white;
    font-size: 30px;
    font-family: "Comfortaa", serif;
    padding-bottom: 36vh;
    text-align: center;
}
.adaptive_filter {
    display: none;
}
.alert {
    position: fixed;
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
    top: 25px;
}
.products_df {
    display: flex;
    flex-wrap: wrap;
    gap: 5vw;
    margin-bottom: 5vw;
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
div:empty {
    display: none;
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
.range-slider {
    width: 90%;
    margin: auto;
    text-align: center;
    position: relative;
    height: 6em;
}

.range-slider svg,
.range-slider input[type="range"] {
    position: absolute;
    left: 0;
    top: 70px;
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

input[type="range"] {
    width: 100%;
}

input[type="range"]:focus {
    outline: none;
}

input[type="range"]:focus::-webkit-slider-runnable-track {
    background: white;
}

input[type="range"]:focus::-ms-fill-lower {
    background: white;
}

input[type="range"]:focus::-ms-fill-upper {
    background: white;
}

input[type="range"]::-webkit-slider-runnable-track {
    width: 100%;
    height: 5px;
    cursor: pointer;
    background: white;
    border-radius: 1px;
    box-shadow: none;
    border: 0;
}
span p {
    margin-top: 3px;
}

input[type="range"]::-webkit-slider-thumb {
    z-index: 2;
    position: relative;
    box-shadow: 0px 0px 0px #000;
    border: 1px solid white;
    height: 18px;
    width: 18px;
    border-radius: 25px;
    background: white;
    cursor: pointer;
    -webkit-appearance: none;
    margin-top: -7px;
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
@media screen and (max-width: 1600px) {
    h3 {
        display: none;
    }
    .adaptive_filter {
        display: flex;
        flex-direction: row;
        h4 {
            color: white;
            font-family: "Comfortaa", serif;
            font-size: 40px;
            margin-top: 50px;
            margin-bottom: 40px;
        }
        img {
            margin-left: 45vw;
        }
    }
    .products_df {
        align-items: center;
        justify-content: center;
    }
    .adaptive {
        margin-left: 5vw;
    }
    .side_filter {
        background: #212529;
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
