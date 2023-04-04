<template>
  <div class="head">
    <p>Админ панель / Заказы</p>
    <h1>Заказы</h1>
  </div>
  <div
    style="
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 65vh;
      width: 100%;
    "
    v-if="load == true"
  >
    <div class="fulfilling-bouncing-circle-spinner">
      <div class="circle"></div>
      <div class="orbit"></div>
    </div>
  </div>
  <div style="width: 90%; margin-left: 5%">
    <div v-for="order in orders" :key="order">
      <div>
        <h2>Заказ №{{ order.id }}</h2>
        <div
          style="
            display: flex;
            flex-wrap: wrap;
            gap: 5vw;
            justify-content: center;
          "
        >
          <div class="card" v-for="product in order.products" :key="product">
            <img :src="product.id_product[0].images[0].img" alt="" />
            <p>{{ product.id_product[0].name }}</p>
            <p class="price">Цена: {{ product.id_product[0].price }} ₽</p>
            <p>Кол-во порций: {{ product.count }}</p>
          </div>
        </div>
        <div class="bottom_order">
          <p>Итого заказа: {{ order.order_price }} ₽</p>
          <p>Статус: {{ order.status }}</p>
          <div style="display: flex; flex-direction: row; gap: 5vw">
            <select v-model="status" name="status" id="status">
              <option selected value="Выберите статус">Выберите статус</option>
              <option value="Собран, ожидает курьера">
                Собран, ожидает курьера
              </option>
              <option value="Передан курьеру">Передан курьеру</option>
              <option value="В пути">В пути</option>
              <option value="Завершен">Завершен</option>
            </select>
            <button @click.prevent="changeStatusOrder(order.id)">
              Изменить статус
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      orders: [],
      status: "",
      load: true,
    };
  },
  mounted() {
    this.getAllOrders();
  },
  methods: {
    getAllOrders() {
      axios.get("/api/orders_admin").then((res) => {
        this.orders = res.data.data;
        this.load = false;
      });
    },
    changeStatusOrder(id) {
      axios
        .post(`/api/order_status/${id}`, {
          status: this.status,
        })
        .then((res) => {
          this.getAllOrders();
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
* {
  color: white;
}
.head {
  display: flex;
  flex-direction: column;
  width: 80%;
  margin-left: 10%;
  margin-top: 2vw;
  font-size: 18px;
  border-bottom: 2px solid #af3131;
  padding-bottom: 35px;
  p {
    color: #af3131;
    font-family: "Comfortaa", serif;
  }
  h1 {
    color: white;
    font-family: "Comfortaa", serif;
    margin-top: 25px;
  }
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
select {
  width: 310px;
  height: 30px;
  background: transparent;
  border: 2px solid #af3131;
  font-family: "Comfortaa", serif;
  border-radius: 5px;
}
select:focus-visible {
  border: 2px solid #af3131;
  font-family: "Comfortaa", serif;
  outline: none;
}
option {
  background-color: #1d2023;
  color: white;
}
button {
  width: 360px;
  height: 50px;
  border-radius: 7px;
  background: #1d2023;
  border: 2px solid #af3131;
  font-family: "Comfortaa", serif;
  font-size: 17px;
  transition: 0.5s;
}
button:hover {
  background: #af3131;
  color: #1d2023;
  cursor: pointer;
}
</style>