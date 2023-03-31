<template>
  <div class="head">
    <p>Админ панель / Пользователи</p>
    <h1>Пользователи</h1>
  </div>
  <div
    style="
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      margin-top: 3vw;
    "
  >
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
    <div class="card" v-else v-for="user in users" :key="user">
      <img
        v-if="user.avatar == 'NULL' || user.avatar == 'undefinded'"
        src="/img/no_avatar.jpg"
        alt=""
      />
      <img v-else :src="user.avatar" alt="" />
      <div>
        <p>{{ user.name }}</p>
        <p>{{ user.surname }}</p>
      </div>
      <p class="email">{{ user.email }}</p>
      <div class="setting">
        <div @click="Ban(user.id)">
          <img src="/img/Ban.svg" alt="" />
          <p>Ban</p>
        </div>
        <div @click="Unban(user.id)">
          <img src="/img/Unban.svg" alt="" />
          <p>Unban</p>
        </div>
        <div @click="Setadmin(user.id)">
          <img src="/img/Setadmin.svg" alt="" />
          <p>Set Admin</p>
        </div>
        <div @click="Setmanager(user.id)">
          <img src="/img/Setadmin.svg" alt="" />
          <p>Set Manager</p>
        </div>
      </div>
    </div>
    <div
      v-if="users.length == 0"
      style="
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 65vh;
        width: 100%;
        color: white;
        font-size: 30px;
        font-family: 'Comfortaa';
      "
    >
      Пользователей нет!
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      users: [],
      load: true,
    };
  },
  mounted() {
    this.allUsers();
  },
  methods: {
    allUsers() {
      axios.get("/api/all_users").then((res) => {
        this.users = res.data;
        this.load = false;
      });
    },
    Ban(id) {
      axios.post(`/api/ban/${id}`);
    },
    Unban(id) {
      axios.post(`/api/unban/${id}`);
    },
    Setadmin(id) {
      axios.post(`/api/setadmin/${id}`);
    },
    Setmanager(id) {
      axios.post(`/api/setmanager/${id}`);
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
.card {
  width: 500px;
  height: 500px;
  background-color: #16181b;
  border-radius: 7px;
  color: white;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 2vw;
  font-family: "Comfortaa", serif;
  font-size: 20px;
  img {
    width: 150px;
    height: 150px;
    border-radius: 100%;
    border: 5px rgba(255, 255, 255, 0.5) solid;
  }
  div {
    display: flex;
    flex-direction: row;
    gap: 0.3vw;
  }
  .email {
    font-family: "Roboto", serif;
    font-size: 14px;
    color: gray;
    margin-top: -1.5vw;
  }
  .setting {
    display: flex;
    flex-direction: row;
    gap: 1vw;
    div {
      display: flex;
      flex-direction: column;
      align-items: center;
      cursor: pointer;
      img {
        border-radius: 0%;
        width: 50px;
        height: 50px;
        border: none;
      }
    }
  }
}
</style>