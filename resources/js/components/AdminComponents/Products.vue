<template>
    <div style="display: flex; flex-direction: row;">
        <div class="add_product">
            <p>Админ панель / Добавить новый товар</p>
            <h1>Добавить новый товар</h1>
            <form action="">
                <label for="file">Выберите фото товара</label>
                <input  type="file"
                        id="file"
                        ref="file"
                        required
                        v-on:change="handleFileUpload()">
                
                <input type="text" v-model="name" placeholder="Введите название товара">
                
                <input type="text" v-model="price" placeholder="Введите цену товара">
                
                <textarea placeholder="Введите описание товара" v-model="discription" name="" id="" cols="30" rows="10"></textarea>

                <select v-model="type" name="Выберите тип" id="">
                    <option disabled>Выберите тип</option>
                    <option v-for="typ in types" :key="typ" :value="typ.id">{{ typ.type }}</option>
                </select>

                <button @click.prevent="creareProduct()">Добавить</button>
            </form>
        </div>
        <div class="all_product">
            <div v-for="product in menu" :key="product">
                    <div :id="product.type.type" class="card">
                        <img :src="product.img" alt="">
                        <p>{{ product.name }}</p>
                        <p>{{ product.type.type }}</p>
                        <p class="price">Цена: {{ product.price }} ₽</p>
                    </div>
                    <!-- <div class="warning" v-else>
                        <h1>Нет товаров по выбранным фильтрам</h1>
                    </div>                    -->
                </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            types: [],
            menu: [],
            name: '',
            price: '',
            discription: '',
            type: '',
            file: ''
        }
    },
    mounted() {
        this.AllTypes()
        this.allMenu()
    },
    methods: {        
        AllTypes(){
                axios.get('/api/type_all')
                    .then(res => {
                        this.types = res.data;
                    })
            },
        allMenu(){
            axios.get('/api/menu_all')
                .then(res => {
                    this.menu = res.data.data;
                })
        },
        creareProduct(){            
            let formData = new FormData();
            formData.append("file", this.file);
            formData.append("name", this.name);
            formData.append("price", this.price);
            formData.append("discription", this.discription);
            formData.append("type", this.type);
            axios.post('/api/create_product',formData,{
                headers: {
                    "Content-Type": "multipart/form-data",
                }
            })
            .then(res => {
                this.name = '',
                this.price = '',
                this.discription = '',
                this.type = ''
                this.file = ''
                this.allMenu()
            })
        },        
        handleFileUpload() {
            this.file = this.$refs.file.files[0];
        },
    },
}
</script>

<style lang="css" scoped>
*{
    color: white;
}

.add_product{
    font-family: "Comfortaa", serif;
    width: 50%; 
    display: flex; 
    flex-direction: column; 
    align-items: center;
}
.add_product p{
    color: #AF3131;
    font-size: 15px;
    margin-top: 120px;
    margin-bottom: 25px;
}
.add_product h1{
    border-bottom: 2px solid #AF3131;
    padding-bottom: 35px;
}
form{
    display: flex;
    flex-direction: column;
    gap: 25px;
    border: 2px solid #AF3131;
    padding: 40px;
    background: #1D2023;
    border-radius: 15px;
    margin-top: 50px;
}
form input,label{
    background: transparent;
    border: 2px #AF3131 solid;
    height: 50px;
    width: 310px;
    border-radius: 15px;
}
label{
    text-align: center;
    padding-top: 10px;
    height: 30px;
    cursor: pointer;
}
input[type=file]{
    display: none;
}
form textarea{
    background: transparent;
    border: 2px #AF3131 solid;
    height: 209px;
    width: 310px;
    border-radius: 15px;
    resize: none;
}
input::placeholder,textarea::placeholder{
    color: white;
    font-family: "Comfortaa", serif;
    font-size: 16px;
    padding-left: 5px;
}
textarea::placeholder{
    padding-top: 7px;
}
button{
    background: transparent;
    width: 310px;
    height: 50px;
    border: 2px solid #AF3131;
    font-family: "Comfortaa", serif;
    border-radius: 15px;
    font-size: 16px;
    transition: .5s;
}
button:hover{
    background: #AF3131;
    color: #1D2023;
    cursor: pointer;
    font-weight: bold;
}
select{
    width: 310px;
    height: 30px;
    background: transparent;
    border: 2px solid #AF3131;
    font-family: "Comfortaa", serif;
    border-radius: 5px;
}
select:focus-visible {
    border: 2px solid #AF3131;
    font-family: "Comfortaa", serif;
    outline: none;
}
option{
    background-color: #1D2023;
    color: white;
}
.all_product{
    width: 50%;
    border-left: 2px solid #AF3131;
    display: flex;
    flex-wrap: wrap;
    gap: 5vw;
    padding: 100px;
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
}
.card p{
    font-size: 17px;
}
.card .price{
    font-size: 25px;
}
.card img{
    width: 240px;
    height: 180px;
    border-radius: 5px;
}
</style>