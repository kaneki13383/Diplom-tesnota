<template>
  <div class="background">
    <form>
      <h2>Данные для заказа</h2>
      <input
        v-model="adress"
        type="text"
        placeholder="Адрес доставки"
        maxlength="100"
      />
      <input
        v-model="number"
        type="text"
        placeholder="Номер телефона"
        maxlength="11"
      />
      <input
        type="text"
        maxlength="20"
        v-model="active_promo"
        placeholder="Промокод (если есть)"
      />
      <p class="warning" v-show="show == true">{{ messge }}</p>
      <button @click.prevent="dataOrder">Сохранить</button>

      <div class="check">
        <input
          type="checkbox"
          v-model="check"
          required
          class="custom-checkbox"
          id="happy"
          name="happy"
        />
        <label for="happy"></label>
        <span
          >Ставя галочку вы соглашаетесь на
          <a href="./Условия сделки.docx"
            >обработку персональных данных</a
          ></span
        >
      </div>
    </form>
    <div class="alert" v-if="show2 == true" @click="show2 = false">
      <p>{{ msg }}</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      id: "",
      adress: localStorage.getItem("adress"),
      number: localStorage.getItem("number"),
      promo: [],
      active_promo: "",
      history_promo: localStorage.getItem("history_promo"),
      show: false,
      show2: false,
      messge: "",
      msg: "",
      check: false,
    };
  },
  updated() {
    if (this.check == false) {
      this.messge = "Вы не поставили галочку";
      this.show = true;
    } else {
      this.messge = "";
      this.show = false;
    }
  },
  methods: {
    dataOrder() {
      if (this.check != false) {
        let formData = new FormData();
        this.getId();
        formData.append("id", this.id);
        formData.append("adress", this.adress);
        formData.append("number", this.number);
        axios
          .post("/api/dataOrder", formData, {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          })
          .then((res) => {
            localStorage.setItem("adress", this.adress);
            localStorage.setItem("number", this.number);
            this.adress = localStorage.getItem("adress");
            this.number = localStorage.getItem("number");
            this.getAdress();
            this.getNumber();
            axios
              .get("/api/promo")
              .then((res) => {
                this.promo = res.data;

                for (let index = 0; index < this.promo.length; index++) {
                  if (this.promo[index].promo == this.active_promo) {
                    if (this.history_promo == this.active_promo) {
                      this.messge = "Этот промокод вы уже использовали";
                      this.show = true;
                    } else {
                      localStorage.setItem("active_promo", this.active_promo);
                    }
                  } else {
                    if (this.active_promo == "") {
                      this.messge = "";
                      this.show = false;
                    } else {
                      this.messge = "Такого промокода не существует";
                      this.show = true;
                    }
                  }
                }
                this.msg = "Данные успешно сохранены!";
                this.show2 = true;
              })

              .cath((err) => {
                this.msg = "Ошибка, попробуйте еще раз.";
                this.show2 = true;
              });
          });
      }
    },

    getId() {
      this.id = localStorage.getItem("id");
    },

    getAdress() {
      this.$store.state.user.adress = localStorage.getItem("adress");
    },

    getNumber() {
      this.$store.state.user.number = localStorage.getItem("number");
    },
  },
};
</script>

<style lang="css" scoped>
.check {
  display: flex;
  flex-direction: row;
  gap: 1vw;
  /* width: 360px; */
  text-align: center;
  font-family: "Roboto", serif;
}
.check span {
  color: #fff;
}
.check span a {
  color: #af3131;
}
.custom-checkbox {
  position: absolute;
  z-index: -1;
  opacity: 0;
}
.custom-checkbox + label {
  display: inline-flex;
  align-items: center;
  user-select: none;
}
.custom-checkbox + label::before {
  content: "";
  display: inline-block;
  width: 1.3em;
  height: 1.3em;
  flex-shrink: 0;
  flex-grow: 0;
  border: 1px solid #af3131;
  border-radius: 0.25em;
  margin-right: 0.5em;
  background-repeat: no-repeat;
  background-position: center center;
  background-size: 50% 50%;
}
.custom-checkbox:checked + label::before {
  border-color: #af3131;
  background-color: #212529;
  background-image: url("./img/галочка.svg");
  background-size: cover;
}
/* стили при наведении курсора на checkbox */
.custom-checkbox:not(:disabled):not(:checked) + label:hover::before {
  border-color: #d77070;
}
/* стили для активного состояния чекбокса (при нажатии на него) */
.custom-checkbox:not(:disabled):active + label::before {
  background-color: #d77070;
  border-color: #d77070;
}
/* стили для чекбокса, находящегося в фокусе */
.custom-checkbox:focus + label::before {
  box-shadow: 0 0 0 0.2rem #6f1f1f;
}
/* стили для чекбокса, находящегося в фокусе и не находящегося в состоянии checked */
.custom-checkbox:focus:not(:checked) + label::before {
  border-color: #d77070;
}
/* стили для чекбокса, находящегося в состоянии disabled */
.custom-checkbox:disabled + label::before {
  background-color: #d77070;
}
.alert {
  position: fixed;
  bottom: 0;
  right: 0;
  margin-right: 40px;
  margin-bottom: 40px;
  width: 300px;
  height: 100px;
  border: 2px solid #af3131;
  background: #1d2023;
  border-radius: 7px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  font-family: "Roboto", serif;
  cursor: pointer;
}
.warning {
  font-size: 20px;
  color: white;
  font-family: "Comfortaa", serif;
}
.background {
  background: #202428;
  border: 3px #af3131 solid;
  width: 60vw;
  height: auto;
  border-radius: 15px;
  color: white;
}
h2 {
  font-size: 24px;
  font-family: "Comfortaa", serif;
}
form {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 80px;
  margin: 40px 0;
}
input {
  width: 80%;
  height: 60px;
  background: #1d2023;
  border: 2px #af3131 solid;
  border-radius: 9px;
  color: white;
  font-size: 20px;
  padding-left: 20px;
}
input::placeholder {
  color: white;
  font-size: 20px;
}
button {
  width: 350px;
  height: 45px;
  background: #1d2023;
  border: 2px #af3131 solid;
  border-radius: 9px;
  color: white;
  font-size: 16px;
  font-family: "Comfortaa", serif;
  transition: 0.5s;
}
button:hover {
  background: #af3131;
  color: #1d2023;
  cursor: pointer;
}
@media screen and (max-width: 900px) {
  button {
    width: 80%;
  }
}
@media screen and (max-width: 540px) {
  .background {
    width: 100%;
  }
}
</style>
