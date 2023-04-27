<template>
  <div class="background">
    <div class="tesnota">
      <h1>Кафе "Теснота"</h1>
      <a href="">
        <button class="btn">
          <svg width="400px" height="70px" viewBox="0 0 400 70" class="border">
            <polyline points="401,1 401,69 -1,69 -1,1 401,1" class="bg-line" />
            <polyline points="401,1 401,69 -1,69 -1,1 401,1" class="hl-line" />
          </svg>
          <router-link to="/catalog/1">Перейти к выбору</router-link>
        </button>
      </a>
    </div>
    <div class="img_eat">
      <img src="/img/main_img.png" alt="" />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
};
</script>

<style lang="css" scoped>
.background {
  background-image: url("/img/section_main_background.png");
  background-repeat: no-repeat;
  background-size: cover;
  background-attachment: fixed;
  height: 90vh;
  display: flex;
  justify-content: space-around;
  color: white;
  align-items: center;
  font-family: "Comfortaa", cursive;
}
h1 {
  font-size: 64px;
  font-weight: normal;
}
.tesnota {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 100px;
}
.tesnota a {
  position: relative;
  border-radius: 28px;
  font-size: 24px;
  background: #af3131;
  /* padding: 30px 120px; */
  width: 400px;
  height: 70px;
  text-align: center;
  cursor: pointer;
}
.btn {
  width: 400px;
  height: 70px;
  cursor: pointer;
  background: transparent;
  border: none;
  border-radius: 28px;
  outline: none;
  transition: 1s ease-in-out;
}

.tesnota a svg {
  position: absolute;
  left: 0;
  top: 0;
  fill: none;
  stroke: #fff;
  stroke-dasharray: 150 280;
  stroke-dashoffset: 290;
  stroke-linecap: round;
  transition: 1s ease-in-out;
  border-radius: 28px;
}

.btn:hover {
  transition: 1s ease-in-out;
}

.btn:hover svg {
  stroke-dashoffset: -290;
}

.btn a {
  color: white;
  font-size: 18px;
  font-weight: 100;
}

@media screen and (max-width: 1020px) {
  .img_eat {
    display: none;
  }
  .tesnota {
    align-items: center;
  }
}
@media screen and (max-width: 530px) {
  h1 {
    text-align: center;
    font-size: 40px;
  }
}
</style>
