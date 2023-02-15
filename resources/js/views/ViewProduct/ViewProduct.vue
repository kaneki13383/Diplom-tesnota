<template>
    <div>
        <p class="pagination"><router-link to="/">Главная</router-link> / <router-link to="/catalog">Меню</router-link> / {{ this.product['name'] }}</p>
        <div style="display: flex; flex-direction: row;">
            <div style="width: 50%; display: flex; flex-direction: row; justify-content: space-around;">
                <img class="img active" :src="this.product['img']" alt="">
            </div>
            <div style="width: 50%; color: white; font-family: 'Roboto', sans-serif;">
                <h1>{{ this.product['name'] }}</h1>
                <p class="price">{{ this.product['price'] }}  ₽ / за порцию</p>
                <div style="display: flex; flex-direction: column; width: 360px;">
                    <button></button>
                    <button v-if="token" @click.prevent="addCart(product.id)">В корзину</button>
                    <button v-if="token">Добавить к столику</button>
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
    export default {
        data() {
            return {
                product: [],
                id: null,
                token: localStorage.getItem('token')
            }
        },
        mounted() {
            this.parseURL()
            this.getProduct()
        },
        methods: {
            getProduct(){
                axios.get(`/api/product/${this.id}`)
                    .then((res) => {
                        this.product = res.data
                        document.title = this.product['name']
                    })
            },
            parseURL(){
                let url = window.location.pathname
                this.id = url.split('/')[2]
            },
            addCart(id){
                axios.post(`/api/cart/${id}`)
            }
        },
    }
</script>

<style lang="css" scoped>
.active{
    width: 650px;
    height: 485px;
    border-radius: 15px;
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