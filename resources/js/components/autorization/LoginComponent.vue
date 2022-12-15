<template>
    <div class="background">
    <div class="form">
        <div style="width: 80%;">
            <router-link to="/"><img src="img/logo.png" alt=""></router-link>
            <p class="welcome">Рады вас видеть снова!!!</p>
            <h1>Войти</h1>
        </div>
        
        <form>
            <div>
                <label for="email">Email</label>
                <input v-model="email" type="email" name="email" placeholder="Введите почту">
            </div>
                 
            <div>
                <label for="password">Пароль</label>
                <input v-model="password" type="password" name="password" placeholder="Придумайте пароль">
            </div>             

            <button @click.prevent="login">Войти ⇀</button>
            <p>Нет аккаунта? <router-link to="/register" href="">Зарегистрироваться</router-link></p>
        </form>
    </div>
    <div class="people">
        <img src="img/people_reg_log.png" alt="">
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
                    localStorage.setItem('name',r.data['name']);
                    localStorage.setItem('surname',r.data['surname']);
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
    .background{
        display: flex;
        flex-direction: row;    
        align-items: flex-end;
        justify-content: space-around;
        margin-top: 12vh;
    }
    img{
        width: 200px;
        height: 55px;
        margin-bottom: 25px;
    }
    .welcome{
        color: rgba(255, 255, 255, 0.5);
    }
    h1{
        color: white;
        font-size: 56px;
        font-family: 'Cabin', sans-serif;
    }
    .form{
        background: #1D2023;
        box-shadow: 10px 11px 20px black;
        border-radius: 20px;
        width: 600px;
        height: 750px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .form p{
        color: rgba(255, 255, 255, 0.2);
        font-family: 'Cabin', sans-serif;
        font-size: 16px;
        margin: 20px 0;
    }
    .form p a{
        color: #AF3131;
    }
    form{
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        margin-top: 20px;
    }
    form div{
        display: flex;
        flex-direction: column;
    }
    input{
        background: transparent;
        border: 2px #AF3131 solid;
        border-radius: 4px;
        width: 480px;
        height: 45px;
        color: white;
        font-size: 16px;
        padding-left: 10px;
        font-family: 'Cabin', sans-serif;
    }
    input::placeholder{
        /* color: white; */
        font-size: 14px;
        font-family: 'Cabin', sans-serif;
    }
    label{
        color: white;
        font-size: 16px;
        font-weight: lighter;
        font-family: 'Cabin', sans-serif;
        margin-bottom: 7px;
    }
    button{
        width: 150px;
        height: 45px;
        border-radius: 23px;
        background-color: #AF3131;
        border: none;
        color: white;
        font-size: 16px;
        font-family: 'Cabin', sans-serif;
        font-weight: bolder;
        cursor: pointer;
    }
    .people img{
        width: 730px;
        height: 740px;
    }
</style>