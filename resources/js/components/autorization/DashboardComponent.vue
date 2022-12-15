<template>
    <!-- <div class="d-f">
        <div class="logout">
            <img src="img/no-avatar.png" v-if="avatar == 'NULL' || avatar == 'undefined'" alt="">
            <img :src="avatar" alt="" v-else>
            <label for="file">Выберите аватар</label>
            <p v-show="file.name">{{file.name}}</p>
            <input type="file" id="file" ref="file" required v-on:change="handleFileUpload()">
            <button v-on:click="submitFile()">Загрузить</button>
            <button @click.prevent="logout" type="submit">Выход</button>
        </div>
        <div class="info">
            <p>Ваше имя: {{name}} {{surname}}</p>
            <p>Ваша почта: {{email}}</p>
        </div>        
    </div> -->
    <div class="d-f">
        <div class="all_info">
            <div class="info_user">
                <img src="img/no_avatar.jpg" v-if="avatar === 'NULL' || avatar === 'undefined'" alt="">
                <img :src="avatar" alt="" v-else>
                <p>{{name}} {{surname}}</p>
                <p>{{email}}</p>
            </div>
            <div v-on:click="showView('change')" id="changeData" class="click">
                <p>Изменить данные</p>
            </div>
            <div v-on:click="showView('data_order')" id="orders" class="click">
                <p>Данные для заказа</p>
            </div>
            <div class="click" id="historyOrders">
                <p>История заказов</p>
            </div>
            <div class="click" id="nowOrders">
                <p>Текущие заказы</p>
            </div>
            <div @click.prevent="logout" class="click">
                <p>Выход</p>
            </div>
        </div>
        <div>
            <div>
                <p class="pagination">Главная / Профиль / {{pagination}} </p>
                <h2>Профиль</h2>
            </div>
            <div class="info_data">
                <transition name="slide-fade" mode="out-in">
                    <ChangeComponent v-if="show == 'change'"></ChangeComponent>
                    <DataOrderComponent v-else-if="show == 'data_order'"></DataOrderComponent>
                </transition>                
            </div>
        </div>
    </div>
    
</template>

<script>
import HeaderComponent from '../header_footer/HeaderComponent.vue';
import ChangeComponent from './ChangeComponent.vue';
import DataOrderComponent from './DataOrderComponent.vue';
export default {

    components:{
        ChangeComponent,
        DataOrderComponent,
    },

    data(){
        return{
            name: '',
            surname: '',
            email: '',
            file: '',
            id: '',
            avatar: '',
            show: 'change',
            pagination: ' Изменить данные'
        }
    },

    mounted(){
        if(localStorage.getItem('x_xsrf_token')){
            HeaderComponent.data.token = localStorage.getItem('x_xsrf_token')
        }
        this.getName()
        this.getSurame()
        this.getEmail()
        this.getAvatar()
            this.getId()
        document.title = this.name;
        this.showView(this.show);
    },

    computed:{
        counter(){
            return this.review.length;
        }
    },

    methods:{
        logout(){
            axios.post('/logout')
            .then( res => {
                localStorage.removeItem('x_xsrf_token')
                localStorage.removeItem('name')
                localStorage.removeItem('surname')
                localStorage.removeItem('email')
                localStorage.removeItem('id')
                localStorage.removeItem('avatar')
                this.$router.push('/')
                // console.log(res);
            })
        },
        submitFile(){
            let formData = new FormData();
            formData.append('file', this.file);
            this.getId()
            formData.append('id', this.id);
            axios.post('/load-avatar',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            ).then(r => {
                let fileName = '../uploads/' + this.file.name;
                localStorage.setItem('avatar', fileName);
                this.avatar = fileName
                this.file = '';
            })
                .catch(function(){
                    console.log('FAILURE!!');
                });
        },
        handleFileUpload(){
            this.file = this.$refs.file.files[0];
        },
        getName(){
            this.name = localStorage.getItem('name')
        },
        getSurame(){
            this.surname = localStorage.getItem('surname')
        },
        getEmail(){
            this.email = localStorage.getItem('email')
        },
        getId(){
            this.id = localStorage.getItem('id')
        },
        getAvatar(){
            this.avatar = localStorage.getItem('avatar')
        },
        showView(text){
            let btns = document.querySelectorAll(".click");
            this.show = text;
            btns.forEach(btn => {
                btn.classList.remove('active');
                if(btn.id === 'changeData' && this.show === 'change'){
                    btn.classList.add('active')
                    this.pagination = 'Изменить данные'
                } else if(btn.id === 'orders' && this.show === 'data_order'){
                    btn.classList.add('active')
                    this.pagination = 'Данные для заказа'
                } else if(btn.id === 'historyOrders' && this.show === 'historyOrders'){
                    btn.classList.add('active')
                } 
                
            })
        }
    }
}
</script>

<style lang="css" scoped>
    .slide-fade-enter-active {
        transition: all .5s ease;
    }
    .slide-fade-leave-active {
        transition: all .5s ;
    }
    .slide-fade-enter, .slide-fade-leave-to {
        transform: translateX(200px);
        opacity: 0;
    }
    .d-f{
        margin-top: 100px;
        display: flex;
        align-items: flex-start;
        justify-content: space-evenly;
    }
    .all_info{
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    .info_user{
        background: rgba(22, 24, 27, 0.7);
        width: 290px;
        height: 300px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 25px;
    }
    .info_user img{
        width: 150px;
        height: 150px;
        border-radius: 100%;
        margin-top: 25px;
        border: 5px rgba(255, 255, 255, 0.5) solid;
    }
    .info_user p{
        color: white;
        font-family: "Comfortaa", serif;
        font-size: 20px;
    }
    .info_user p:last-child{
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
    }
    .click{
        width: 290px;
        height: 85px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        background: rgba(22, 24, 27, 0.7);
    }
    .active{        
        background: rgba(175, 49, 49, 0.58);
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
        transition: 0.5s;
    }
    .click p{
        font-size: 20px;
        font-family: "Comfortaa", serif;
        color: white;
        cursor: pointer;
    }
    .info_data{
        background: rgba(22, 24, 27, 0.7);
        border-radius: 15px;
        padding: 50px;
        margin-bottom: 100px;
    }
    .pagination{
        color: #AF3131;
        font-size: 18px;
        font-family: "Comfortaa", serif;
    }
    h2{
        font-family: "Comfortaa", serif;
        font-size: 32px;
        color: white;
        margin-top: 15px;
        margin-bottom: 30px;
    }
</style>
