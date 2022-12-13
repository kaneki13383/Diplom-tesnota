<template>
  <div class="form">
    <div class="background">
        <h3> <router-link to="/"><span>—</span> Регистрация <span>—</span></router-link></h3>
        <div class="info_name">
            <input v-model="name"  class="block mt-1 w-full" type="text" name="name" placeholder="Введите имя"   />
         </div>     
        <!-- Email Address -->
        <div class="info_email">
            <input v-model="email"  class="block mt-1 w-full" type="email" name="email" placeholder="Введите почту"  />
        </div>      
        <!-- Avatar -->
        <!-- <div class="info_avatar">
            <input type="file" id="customFile" @change="onAttachmentChange" placeholder="Вставьте картинку">
        </div>       -->
        <!-- Password -->
        <div class="info_password">
            <input v-model="password" class="block mt-1 w-full" type="password" name="password" placeholder="Введите пароль"  />
        </div>      
        <!-- Confirm Password -->
        <div class="info_confirm_passord">
            <input v-model="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" placeholder="Введите пароль еще раз"  />
        </div>      
        <div class="info_link">
            <button @click.prevent="register" type="submit">Отправить</button>
        </div>
        <div>
        <router-link class="info_link_text" to="/login">
                Уже зарегистрирован?
        </router-link>
       
        </div>
        <div>
        <a href="https://xn--b1aew.xn--p1ai/" class="info_link_text">
                Политика конфиденциальности
            </a>
        </div> 
    </div>
  </div>
</template>

<script>
export default {
  name: 'Registration',

  data(){
    return{
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
    }
  },

  mounted(){    
    document.title = "Регистрация"
  },

  methods: {
    register(){
        axios.get('/sanctum/csrf-cookie').then(Response => {
                axios.post('/register', {name: this.name, email: this.email, password: this.password, password_confirmation: this.password_confirmation})
            .then(r =>{
                console.log(r)
                this.name = '';
                this.email = '';
                this.password = '';
                this.password_confirmation = '';         
                    localStorage.setItem('x_xsrf_token', r.config.headers['X-XSRF-TOKEN']);
                    localStorage.setItem('user',r.data['name']);
                    localStorage.setItem('email',r.data['email']);
                    localStorage.setItem('id',r.data['id']);
                    localStorage.setItem('avatar',r.data['avatar']);
                this.$router.push('/dashboard')
            })
        })
    }
    },
};
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
    .form{
        background-image: url(img/image10.png);
        background-position-y: -20vw;
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
        height: 75%;
        padding: 5vw 0;
    }
    .info_name{
        color: white;
        font-size: 1vw;
        font-family: 'Comfortaa', cursive;
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
    .info_confirm_passord{
        color: white;
        font-size: 1vw;
        font-family: 'Comfortaa', cursive;
    }
    .info_link_text{
        color: white;
        font-size: 1vw;
        font-family: 'Comfortaa', cursive;
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
    
    .form button{
        width: 25vw;
        height: 50px;
        background-color: transparent;
        color: white;
        font-size: 1.2vw;
        font-family: 'Philosopher', sans-serif;
        border: #9FC926 2px solid;
        margin-top: 5vh;
    }
    .form button:hover{
        background-color: #9FC926;
        color: #191D21;
        transition-duration: 0.5s;
    }
    input::placeholder{
        color: white;
        font-size: 1vw;
        font-family: 'Comfortaa', cursive;
    }
    body{
        background-image: url(../../img/image10.png);
        background-repeat: no-repeat;
        background-position: center;
    }
    h1{
        color: white;
        font-size: 2vw;
        font-family: 'Comfortaa', cursive; 
    }
    .logo{
        display: flex;
        justify-content: center;
        margin-top: 2vw;
    }
</style>