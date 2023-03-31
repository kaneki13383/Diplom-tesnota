<template>
  <div class="head">
    <p>Админ панель / Главная</p>
    <h1>Главная</h1>
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
  <div class="graph" v-else v-show="comments.length != 0">
    <div class="comments" v-for="comment in comments" :key="comment">
      <div>
        <img :src="comment.id_user.avatar" alt="" />
        <p>{{ comment.id_user.name }} {{ comment.id_user.surname }}</p>
      </div>

      <p>{{ comment.comment }}</p>
      <div>
        <p style="color: #af3131; cursor: pointer" @click="delComm(comment.id)">
          Delete
        </p>
      </div>
    </div>
  </div>
  <div
    v-if="comments.length == 0"
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
    Комментариев нет!
  </div>
</template>

<script>
export default {
  data() {
    return {
      comments: [],
      load: true,
    };
  },
  mounted() {
    this.allComm();
  },
  methods: {
    allComm() {
      axios.get("/api/all/comments").then((res) => {
        this.comments = res.data.data;
        this.load = false;
      });
    },
    delComm(id) {
      axios.post("/api/delete/comment", { id: id }).then((res) => {
        this.allComm();
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
.graph {
  width: 80%;
  margin-left: 10%;
  color: white;
}
.comments {
  display: flex;
  flex-direction: column;
  margin: 2vw;
  padding: 2vw;
  padding-top: 0;
  padding-bottom: 0;
  border: 2px solid #af3131;
  background: #1d2023;
  border-radius: 7px;
  width: auto;
  div {
    display: flex;
    flex-direction: row;
    align-items: center;
    p {
      font-family: "Comfortaa", serif;
      font-size: 20px;
    }
  }
  img {
    width: 80px;
    height: 80px;
    border-radius: 100%;
    margin-top: 25px;
  }
  p {
    font-size: 16px;
    font-family: "Roboto", serif;
    margin: 1vw;
  }
}
</style>