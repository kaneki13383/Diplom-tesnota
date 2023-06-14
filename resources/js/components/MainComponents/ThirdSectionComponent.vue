<template>
  <div class="d-f_sec">
    <div class="text">
      <h4>Здесь вы можете оставить свой отзыв</h4>
      <p>
        Для этого будет достаточно вашего телефонного номера и электронного адреса. Так же
        вы можете добавить в комментарии свои пожелания и упростить работу для нашего
        сервиса :)
      </p>
    </div>
    <div class="request">
      <input type="text" v-model="number" placeholder="тел" maxlength="11" />
      <input type="text" v-model="email" placeholder="почта" maxlength="100" />
      <textarea
        maxlength="100"
        v-model="text"
        name=""
        id=""
        cols="30"
        rows="10"
        placeholder="коментарий"
      ></textarea>
      <button @click.prevent="addReview()">Отправить</button>
      <img src="img/bottom_form_main.svg" alt="" />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      number: "",
      email: "",
      text: "",
    };
  },
  methods: {
    addReview() {
      axios
        .post("/api/add_review", {
          number: this.number,
          email: this.email,
          text: this.text,
        })
        .then((res) => {
          this.number = "";
          this.email = "";
          this.text = "";
        });
    },
  },
};
</script>

<style lang="css" scoped>
h4 {
  font-size: 64px;
  font-family: "Comfortaa", cursive;
  color: #af3131;
  width: 810px;
  text-align: center;
}
.d-f_sec {
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  margin-bottom: 175px;
}
.text p {
  color: white;
  font-family: "Roboto", sans-serif;
  font-weight: bold;
  width: 800px;
  margin-top: 50px;
  text-align: center;
  font-size: 30px;
}
.request {
  height: 730px;
  width: 600px;
  border: 6px #af3131 solid;
  border-radius: 95px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-evenly;
  padding-top: 50px;
}
input[type="text"] {
  width: 435px;
  height: 65px;
  background-color: #1d2023;
  border: 5px #af3131 solid;
  border-radius: 9px;
  color: white;
  font-size: 20px;
  font-family: "Cabin", sans-serif;
  font-weight: bold;
  padding-left: 20px;
}
input::placeholder {
  color: white;
  font-size: 20px;
  font-family: "Cabin", sans-serif;
  font-weight: bold;
}
textarea::placeholder {
  color: white;
  font-size: 20px;
  font-family: "Cabin", sans-serif;
  font-weight: bold;
}
textarea {
  width: 435px;
  background-color: #1d2023;
  border: 5px #af3131 solid;
  border-radius: 9px;
  resize: none;
  color: white;
  font-size: 20px;
  font-family: "Cabin", sans-serif;
  font-weight: bold;
  padding-left: 20px;
  padding-top: 20px;
}
.request button {
  width: 250px;
  height: 65px;
  background: transparent;
  border: 5px #af3131 solid;
  border-radius: 9px;
  color: white;
  font-size: 20px;
  font-family: "Comfortaa", cursive;
  transition: 0.5s;
  cursor: pointer;
}
.request button:hover {
  background: #af3131;
  color: #1d2023;
}
img {
  position: relative;
  top: 21px;
  right: 2px;
  width: 605px;
}
@media screen and (max-width: 1670px) {
  .d-f_sec {
    flex-direction: column;
    gap: 5vw;
  }
}
@media screen and (max-width: 1200px) {
  .d-f_sec {
    margin-top: 30vw;
  }
}
@media screen and (max-width: 850px) {
  h4 {
    font-size: 50px;
    width: 80%;
  }
  .text {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  .text p {
    font-size: 20px;
    width: 80%;
    text-align: center;
  }
  input::placeholder {
    font-size: 20px;
  }
  textarea::placeholder {
    font-size: 20px;
  }
}
@media screen and (max-width: 650px) {
  .request {
    width: 500px;
  }
  input[type="text"] {
    width: 60%;
  }
  textarea {
    width: 60%;
  }
  img {
    width: 500px;
    top: 23px;
  }
  h4 {
    font-size: 35px;
  }
}
@media screen and (max-width: 550px) {
  .request {
    width: 400px;
  }
  img {
    width: 380px;
    top: 27px;
  }
}
</style>
