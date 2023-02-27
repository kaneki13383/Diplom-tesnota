<template>
    <div>
        <p class="pagination"><router-link to="/">Главная</router-link> / <router-link to="/catalog">Меню</router-link> / {{ this.product['name'] }}</p>
        <div style="display: flex; flex-direction: row; margin-left: 8vw;">
            <div style="width: 50%;">
                <carousel :items-to-show="1">
                    <slide v-for="img in this.product.images" :key="img">
                        <img class="active" :src="img.img" alt="">
                    </slide>

                    <template #addons>
                        <navigation />
                        <pagination />
                    </template>
                </carousel>
            </div>
            <div style="width: 50%; color: white; font-family: 'Roboto'; margin-left: 4vw;">
                <h1>{{ this.product['name'] }}</h1>
                <p class="price" v-if="active_promo">{{ this.product['price'] - (this.product['price'] * .15)  }}  ₽  / <span v-if="this.product['name'] == 'Пончики шоколадные'">шт</span><span v-else>порция</span></p>
                <p class="price" v-else>{{ this.product['price'] }}  ₽ / <span v-if="this.product['name'] == 'Пончики шоколадные'">шт</span><span v-else>порция</span></p>
                <div style="display: flex; flex-direction: column; width: 360px;">
                    <div v-show="token" class="count">
                        <p>{{ counter }} / кол-во <span v-if="this.product['name'] == 'Пончики шоколадные'">шт</span><span v-else>порций</span></p>
                        <div>
                            <button @click="counter++">+</button>
                            <button @click="Plus">-</button>
                        </div>                        
                    </div>
                    <button v-show="token" @click.prevent="addCart(product.id), countCart()">В корзину</button>
                    <button v-show="token">Добавить к столику</button>
                </div>
            </div>
        </div>
        <div style="width: 90%; border-top: 2px solid #af3131; color: white; display: flex; flex-direction: column; justify-content: center; align-items: center;  margin-top: 115px; margin-left: 5%;">
            <h2>Описание</h2>
            <p class="discription">{{ this.product['discription'] }}</p>
        </div>
    </div>
</template>

<script>
import StyleComponent from '../../components/StyleComponent.vue'
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
    export default {
        components: {
            Carousel,
            Slide,
            Pagination,
            Navigation,
            StyleComponent
        },
        data() {
            return {
                product: [],
                id: null,
                token: localStorage.getItem('x_xsrf_token'),
                active_promo: localStorage.getItem('active_promo'),
                counter: 1
            }
        },
        mounted() {
            this.parseURL()
            this.getProduct()
        },
        methods: {
            Plus(){
                if(this.counter == 1){
                    this.counter = 1
                }
                else{
                    this.counter--
                }
            },
            countCart(){
                this.cart_count = 0
                axios.get('/api/cart/all')
                .then(res => {
                    for (let index = 0; index < res.data.data.length; index++) {
                        this.cart_count += res.data.data[index].count
                    }
                    this.$store.state.user.cart_count = this.cart_count;
                })
        },
            getProduct(){
                axios.get(`/api/product/${this.id}`)
                    .then((res) => {
                        this.product = res.data.data[0]
                        document.title = this.product['name']
                        console.log(this.product);
                    })
            },
            parseURL(){
                let url = window.location.pathname
                this.id = url.split('/')[2] 
            },
            addCart(id){
                axios.post(`/api/cart/${id}`,{counter: this.counter})
            }
        },
    }
</script>

<style lang="css" scoped>
.count{
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    gap: 1vw;
    width: auto;
    height: 4vw;
    margin-top: 2vw;
    background: #1D2023;
    border: 2px solid #af3131;
    border-radius: 7px;
}
.count p{
    font-size: 20px;
}
.count div{
    display: flex;
    flex-direction: column;
}
.count button{
    width: 30px;
    height: 30px;
    margin: 0px;
}
.active{
    width: 750px;
    height: auto;
    border-radius: 15px;
    margin-left: 1.5vw;
}
.pagination{
    color: #af3131;
    text-decoration: none;
    font-size: 18px;
    font-family: "Comfortaa", serif;
    margin-top: 60px;
    margin-bottom: 100px;
    margin-left: 150px;
}
.pagination a{
    text-decoration: none;
    color: #af3131;
}
.price{
    margin-top: 40px;
    font-size: 25px;
}
div button{
    background: #1D2023;
    color: white;
    border: 2px solid #af3131;
    height: 50px;
    border-radius: 7px;
    margin-top: 40px;
    font-family: 'Roboto', sans-serif; 
    font-size: 17px;
    transition: .5s;
}
div button:hover{
    background: #af3131;
    color: #1D2023;
    cursor: pointer;
    font-weight: bold;
}
div h2{
    font-family: "Comfortaa", serif;
    font-size: 30px;
    margin-top: 30px;
    margin-bottom: 60px;
}
div .discription{
    font-family: 'Roboto', sans-serif; 
    font-size: 20px;
    text-align: center;
    margin-bottom: 100px;
}
</style>