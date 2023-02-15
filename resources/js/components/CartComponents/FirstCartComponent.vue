<template>
    <div>
        <p class="pagination"><router-link to="/">Главная</router-link> / Корзина</p>
        <div>
            <div v-for="product in cart" :key="product">
                <div class="item">
                    <img :src="product.id_product.img" alt="">
                    <p>{{ product.id_product.name }}</p>
                    <p>Кол-во порций: {{ product.count }}</p>
                    <p>Цена: {{ product.id_product.price * product.count }} ₽</p>
                    <div class="delete" @click.prevent="deleteProduct(product.id_product.id)">
                        <svg width="45" height="45" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect width="60" height="60" fill="url(#pattern0)"/>
                            <defs>
                                <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                    <use xlink:href="#image0_126_1806" transform="scale(0.0111111)"/>
                                </pattern>
                                <image id="image0_126_1806" width="90" height="90" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAB40lEQVR4nO2cS2rDQBBEtYpz8ijnyWLQhfK5RRmBDAaHENszPVXd9UDglal+SK0RGvWyGGOMMcYYY4wxxpgbAJwAvAP4Po7990lFFRTyA3gB8IFbNgCvCzkS+f8IyRdWNf8/QvKEVc1/R0hK2RL5HwhJJVsi/3F3bnicNvNuLpP/WPY8S5shu4PkC2tE2H2N2YMtso080S5+40dJdJjszpJ3PpeA0Cv60ka2kY7t4pq3UXlHB28jZCtljboUu7cRhYzyhYA4W5qCQJipC0yFgSjLEBgKBEGGEGYWiiqSZxaMapJnFI6qkiMFoLrkCBGw5LBH4DbgP7neeN/LoLOvdrsQlL2lkUwse0snmVB2XslEsvNLJpBdR/JE2fUkT5BdV3KgbEsOkG3J11h0AHDrSCH5Qt0WAi/vUkqud2bDj+AlJOc/s8EjOa9s8EnOJ5tYch7ZfjkbgLcbBOANNAF4S1gA3uQYgLftBsCwFw4EGYbCVCCIsnSFsTAQZnoK5oJAnC1dIRDImOazXwhlHTWvQ/2je6l5HcpjJKTmdWzCg1Fk5nU08VE/EvM6modXZRpnliW/xIC+LPklRk5myS8xRDVLfomxwFnyH6uRfen3dRyr0me/EM9vjDHGGGOMMcYYswRyBpias+umnbidAAAAAElFTkSuQmCC"/>
                            </defs>
                        </svg>
                    </div>
                </div>
            </div>
            <div>
                Итого: {{ summ }}
            </div>
            <div class="cart_empty" v-if="cart.length == 0">
                <h1>Корзина пуста</h1>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                cart: [],
                summ: 0
            }
        },
        mounted() {
            this.getCart()
        },
        methods: {
            getCart(){
                axios.get('/api/cart/all')
                    .then(res => {
                        this.cart = res.data.data
                        this.summ = 0
                        for (let index = 0; index < this.cart.length; index++) {
                            this.summ += this.cart[index].id_product.price * this.cart[index].count
                        }
                    })
            },
            deleteProduct(id){
                axios.post(`/api/cart_delete/${id}`)
                    .then(res => {
                        this.getCart()
                    })
            }
        },
    }
</script>

<style lang="css" scoped>
*{
    color: white;
}
.pagination{
    color: #af3131;    
    font-size: 18px;
    font-family: "Comfortaa", serif;
    margin-left: 10%;
    margin-top: 60px;
}
.pagination a{
    color: #af3131;
}
.item{
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    gap: 155px;
    margin-bottom: 5vw;
    border-bottom: 2px solid #af3131;
    width: 90%;
    margin-left: 5%;
    padding-bottom: 40px;
}
.item p{
    font-family: "Roboto", serif;
    font-size: 25px;
}
.item:first-child{
    margin-top: 100px;
}
.item img{
    width: 200px;
    height: 150px;
    border-radius: 14px;
}
.cart_empty{
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 29.5vh 0;
    font-family: "Comfortaa", serif;
    font-size: 20px;
}
.delete{
    cursor: pointer;
}
</style>