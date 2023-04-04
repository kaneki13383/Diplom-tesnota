<template>
  <div
    style="
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 65vh;
      width: 60vw;
    "
    v-if="load == true"
  >
    <div class="fulfilling-bouncing-circle-spinner">
      <div class="circle"></div>
      <div class="orbit"></div>
    </div>
  </div>
  <div class="background" v-else>
    <div v-if="orders.length != 0">
      <div v-for="order in orders" :key="order">
        <div>
          <h2>Заказ №{{ order.id }}</h2>
          <div
            style="
              display: flex;
              flex-wrap: wrap;
              gap: 5vw;
              justify-content: space-around;
            "
          >
            <div v-for="product in order.products" :key="product">
              <router-link
                :to="{ path: '/product/' + product.id_product[0].id }"
              >
                <div class="card">
                  <img :src="product.id_product[0].images[0].img" alt="" />
                  <p>{{ product.id_product[0].name }}</p>
                  <p class="price">Цена: {{ product.id_product[0].price }} ₽</p>
                  <p>Кол-во порций: {{ product.count }}</p>
                </div>
              </router-link>
            </div>
          </div>
          <div class="bottom_order">
            <p>Итого заказа: {{ order.order_price }} ₽</p>
            <p>Статус: {{ order.status }}</p>
          </div>
        </div>
      </div>
    </div>
    <div v-else>
      <h1>Вы еще не завершили ни одного заказа!</h1>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      orders: [],
      load: true,
    };
  },
  mounted() {
    this.getOrders();
  },
  methods: {
    getOrders() {
      axios.get("/api/orders_end").then((res) => {
        this.orders = res.data.data;
        this.load = false;
      });
    },
  },
};
</script>

<style lang="scss" scoped>
.fulfilling-bouncing-circle-spinner,
.fulfilling-bouncing-circle-spinner * {
  box-sizing: border-box;
}

.fulfilling-bouncing-circle-spinner {
  height: 60px;
  width: 60px;
  position: relative;
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
h1 {
  font-family: "Comfortaa", serif;
  margin: 15vw 0 15vw 12vw;
}
.background {
  background: #202428;
  border: 3px #af3131 solid;
  width: 60vw;
  height: auto;
  border-radius: 15px;
  color: white;
}
.card img {
  width: 240px;
  height: 180px;
  border-radius: 5px;
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
  font-family: "Comfortaa", serif;
  text-align: center;
}
.card .price {
  font-size: 25px;
}
h2 {
  font-family: "Comfortaa", serif;
  text-align: center;
  margin: 2vw 0;
}
.bottom_order {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  width: 85%;
  margin-left: 7.5%;
  font-family: "Comfortaa", serif;
  font-size: 20px;
  margin-top: 4vw;
  margin-bottom: 4vw;
}
.bottom_order p {
  border-bottom: 2px solid #af3131;
  padding-bottom: 10px;
}
@media screen and (max-width: 658px) {
  .card {
    width: 50vw;
    height: auto;
    padding-top: 5vw;
    padding-bottom: 5vw;
  }
  .card img {
    width: 40vw;
    height: auto;
  }
  .card p {
    font-size: 14px;
  }
  .bottom_order p {
    font-size: 15px;
  }
}
</style>