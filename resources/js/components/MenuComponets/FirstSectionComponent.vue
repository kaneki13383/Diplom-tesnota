<template>
    <div class="all">
        <div class="side_filter">
            <h2>Фильтры</h2>
            <div class="d-f gap">
                <div class="d-f">
                    <div>
                        <div class="filter">
                            <p>Виды</p>
                        </div>
                    </div>
                    <div class="last_active">
                        <div class="active">
                            <p>Дессерты</p>
                        </div>
                        <div class="active">
                            <p>Закуски</p>
                        </div>
                        <div class="active">
                            <p>Напитки</p>
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
                                <span @change="slider"><p> От </p><input v-model.number="minPrice" type="number"  min="0" max="1000"/> <p>До</p> <input  v-model.number="maxPrice" type="number"  min="0" max="1000"/></span>
                                <input @change="slider" v-model.number="minPrice" min="0" max="1000" step="1" type="range" />
                                <input @change="slider" v-model.number="maxPrice" min="0" max="1000" step="1" type="range" />
                                <svg width="100%" height="24"></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="width: 70%; margin-left: 20vw;">
            <p class="pagination">
                <router-link to="/"> Главная </router-link> / О нас
            </p>
            <h3>Меню</h3>
            <div class="products_df">
                <div v-for="product in menu" :key="product">
                    <div class="card" v-if="product.price >= minPrice && product.price <= maxPrice">
                        <img :src="product.img" alt="">
                        <p>{{ product.name }}</p>
                        <p class="price">Цена: {{ product.price }} ₽</p>
                        <button>Купить</button>
                    </div>
                    
                </div>
            </div>            
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                minPrice: 0,
                maxPrice: 0,
                menu: [],
                price: []
            }
        },
        mounted(){
            this.allMenu()
        },
        methods: {
            slider: function() {
                if (this.minPrice > this.maxPrice) {
                    let tmp = this.maxPrice;
                    this.maxPrice = this.minPrice;
                    this.minPrice = tmp;
                }
            },
            allMenu(){
                axios.get('/api/menu_all')
                    .then(res => {
                        this.menu = res.data;

                        for (let index = 0; index < this.menu.length; index++) {
                            this.price.push(this.menu[index]['price']);             
                        }
                        this.minPrice = Math.min.apply(null, this.price);
                        this.maxPrice = Math.max.apply(null, this.price);
                    })
            }
        }
    }
</script>

<style lang="css" scoped>
.side_filter{
    position: fixed;
    left: 100px;
}
.products_df{
    display: flex;
    flex-wrap: wrap;
    gap: 5vw;
}
.pagination,
a {
    color: #af3131;
    font-size: 18px;
    font-family: "Comfortaa", serif;
    margin-top: 30px;
}
.card{
    width: 350px;
    height: 400px;
    background: #1d2023;
    border: 2px solid #AF3131;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 1.4vw;
    color: white;
    transition: .5s;
    cursor: pointer;
}
.card:hover{
    box-shadow: 8px 7px 20px #af3131;
}
.card p{
    font-size: 17px;
}
.card .price{
    font-size: 25px;
}
.card button{
    width: 240px;
    height: 40px;
    background: transparent;
    border: 2px solid #AF3131;
    color: white;
    border-radius: 7px;
    cursor: pointer;
    transition: .5s;
}
.card button:hover{
    background: #AF3131;
    color: #1d2023;
    font-weight: bold;
}
.card img{
    width: 240px;
    height: 180px;
    border-radius: 5px;
}
.all{
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
.range-slider input[type=range] {
  position: absolute;
  left: 0;
  top: 70px;
}

input[type=number] {
  border: none;
  color: white;
  text-align: center;
  font-size: 1.2vw;
  background: transparent;
}

input[type=number]::-webkit-outer-spin-button,
input[type=number]::-webkit-inner-spin-button {
  -webkit-appearance: none;
}

input[type=number]:invalid,
input[type=number]:out-of-range {
  border: 2px solid #ff6347;
}

input[type=range] {
  width: 100%;
}

input[type=range]:focus {
  outline: none;
}

input[type=range]:focus::-webkit-slider-runnable-track {
  background: white;
}

input[type=range]:focus::-ms-fill-lower {
  background: white;
}

input[type=range]:focus::-ms-fill-upper {
  background: white;
}

input[type=range]::-webkit-slider-runnable-track {
  width: 100%;
  height: 5px;
  cursor: pointer;
  background: white;
  border-radius: 1px;
  box-shadow: none;
  border: 0;
}
span p{
    margin-top: 3px;
}

input[type=range]::-webkit-slider-thumb {
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
span{
    display: flex;
    margin-top: 20px;
}
h2{
    color: white;
    font-family: "Comfortaa", serif;
    font-size: 40px;
    margin-top: 100px;
    margin-bottom: 40px;
}
h3{
    color: white;
    font-family: "Comfortaa", serif;
    font-size: 40px;
    margin-top: 50px;
    margin-bottom: 40px;
}
.filter{
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
.active{
    color: white;
    font-family: "Comfortaa", serif;
    font-size: 30px;
    width: 270px;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: rgb(175, 49, 49, 58%);
    font-size: 18px;
    border-bottom: 1px white solid;
}
.d-f{
    display: flex;
    flex-direction: column;
    gap: 5px;
}
.d-f .d-f:nth-child(2) .last_active{
    height: 117px;
}
.d-f .d-f:nth-child(2) .active{
    height: 100%;
}
.gap{
    gap: 10px;
}
.last_active :last-child{
    border-bottom: none;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
}
</style>
