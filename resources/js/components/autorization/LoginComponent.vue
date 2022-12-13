<template>
    <div class="log">
        <div class="background">
        <h3><router-link to="/"><span>—</span> Авторизация <span>—</span></router-link></h3>
        <div class="info_email">
            <input v-model="email" type="email" name="email" placeholder="Email">
        </div>
        <div class="info_password">
            <input v-model="password" type="password" name="password" placeholder="Пароль">
        </div>
            <button @click.prevent="login" type="submit">Войти</button>
        <div>
            <router-link class="info_link_text" to="/register">Нет аккаунта?</router-link>
        </div>
        <div>
            <a  class="info_link_text">
                Политика конфиденциальности
            </a>
        </div>
        </div> 
    </div>
</template>

<script>
export default {
    name: 'Login',

    data(){
        return{
            email: null,
            password: null,
        }
    },
    mounted(){    
        document.title = "Войти"
    },

    methods: {
        login(){
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', { email: this.email, password: this.password })
                .then(r => {
                    console.log(r);
                    this.email = '';
                    this.password = '';
                    localStorage.setItem('x_xsrf_token', r.config.headers['X-XSRF-TOKEN']);
                    localStorage.setItem('user',r.data['name']);
                    localStorage.setItem('email',r.data['email']);
                    localStorage.setItem('id',r.data['id']);
                    localStorage.setItem('avatar',r.data['avatar']);
                    if(r.data['role'] == 0){
                        this.$router.push('/dashboard');
                    }
                    else{
                        this.$router.push('/admin');
                    }
                })
                .catch( err => {
                    console.log(err.response)
                })
            })
            
        },

        
    }
}
</script>

<style lang="css" scoped>
    h3{
        color: white;
        text-align: center;
        font-size: 2vw;
        margin-top: -1.5vw;
        font-family: 'Comfortaa', cursive;
    }
    h3 span{
        color: #9FC926;
    }
    .info_email{
        color: white;
        font-size: 1vw;
        font-family: 'Comfortaa', cursive;
    }
    .info_password{
        color: white;
        font-size: 1vw;
        font-family: 'Comfortaa', cursive;
    }
    .log{
        background-image: url('img/image22.png');
        background-size: 100%;
        background-repeat: no-repeat;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .background{
        background-color: #191d21dc;
        display: flex;
        align-items: center;
        flex-direction: column;
        gap: 1vw;
        width: 40%;
        height: 55%;
        padding: 5vw 0;
    }
    input{
        background-color: transparent;
        border: none;
        border-bottom: #9FC926 2px solid;
        outline: none;
        width: 25vw;
        height: 50px;
        color: white;
        padding: 5px;
    }
    
    .log button{
        width: 25vw;
        height: 50px;
        background-color: transparent;
        color: white;
        font-size: 1.2vw;
        font-family: 'Philosopher', sans-serif;
        border: #9FC926 2px solid;
        margin-top: 5vh;
    }
    .log button:hover{
        background-color: #9FC926;
        color: #191D21;
        transition-duration: 0.5s;
    }
    input::placeholder{
        color: white;
        font-size: 1vw;
        font-family: 'Comfortaa', cursive;
    }
    .info_link_text{
        color: white;
        font-size: 1vw;
        font-family: 'Comfortaa', cursive;
    }
</style>