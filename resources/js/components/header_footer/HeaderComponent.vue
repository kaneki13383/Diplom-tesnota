<template>
    <div>
        <header id="menu">
            <div class="d-f_adaptive">
                <div>
                    <router-link to="/">
                        <img src="/img/logo.png" alt="">
                    </router-link>
                </div>

                <div>
                    <a class="burger" id="burger" v-on:click="display()">
                        <img src="img/burger_menu.svg" alt="">
                    </a>
                </div>
            </div>

            <ul id="navig">
                <li id="logo">
                    <router-link to="/">
                        <img src="/img/logo.png" alt="">
                    </router-link>
                </li>
                <li><router-link to="/">Главная</router-link></li>
                <li><router-link to="/catalog">Меню</router-link></li>
                <li v-show="token"><router-link to="">Корзина</router-link></li>
                <li><router-link to="/about">О нас</router-link></li>
                <li>
                    <input type="search" placeholder="Поиск" />
                    <!-- <img
                        class="search"
                        src="img/search.png"
                        alt=""
                    /> -->
                </li>
                <li>
                    <router-link v-show="!token" class="register" to="/register"
                        >Регистрация</router-link
                    >
                    <router-link v-show="token" to="/dashboard">{{
                        this.$store.state.user.name
                    }}</router-link>
                </li>
            </ul>


               
                <!-- <a class="burger-menu_button" id="burger" v-on:click="display()">
                    <span class="burger-menu_lines"></span>
                </a> -->
        </header>
    </div>
</template>

<script>
export default {
    data() {
        return {
            token: "",
            name: "",
            width: window.innerWidth,
        };
    },

    watch: {
        $route() {
            this.getToken();
            this.getName();
        },
    },

    mounted() {
        this.getToken();
        this.getName();
        window.addEventListener("resize", function(){
            let width_window = this.innerWidth;

            // console.log(width_window);
            if(width_window >= 768){
                document.getElementById('navig').style.display = 'flex'
                document.getElementById('navig').style.opacity = '1'
            }else{
                document.getElementById('navig').style.display = 'none'
                document.getElementById('burger').style.display = 'block'
                document.getElementById('navig').style.opacity = '0'
                document.getElementById('burger').style.opacity = '1'
            }
        }, false);
    },

    updated() {
        this.getToken();
        this.getName();
    },

    methods: {
        getToken() {
            this.token = localStorage.getItem("x_xsrf_token");
        },
        getName() {
            this.$store.state.user.name = localStorage.getItem("name");
        },
        display(){
            if(document.getElementById('navig').style.opacity == '1'){
                document.getElementById('navig').style.opacity = '0'
                document.getElementById('navig').style.display = 'none'
            }else{
                document.getElementById('navig').style.opacity = '1'
                document.getElementById('navig').style.display = 'flex'
            }
        }
    },
};
</script>

<style lang="css" scoped>
.d-f_adaptive{
    display: none;
}
.burger{
    display: none;
}
header {
    margin-top: 30px;
    margin-bottom: 30px;
}
ul {
    display: flex;
    justify-content: space-evenly;
    align-items: center;
}
img {
    width: 150px;
    height: 40px;
}
a {
    color: white;
    font-family: "Comfortaa", cursive;
    font-size: 18px;
}
li input {
    height: 44px;
    width: 400px;
    background: transparent;
    border: white 2px solid;
    border-radius: 13px;
    color: white;
    font-family: "Comfortaa", cursive;
    padding-left: 10px;
    margin-right: 20px;
}
li input::placeholder {
    color: white;
}
.search {
    position: relative;
    width: 30px;
    height: 30px;
    /* margin-left: -70px; */
    /* margin-bottom: -10px; */
    left: -70px;
    bottom: -10px;
    z-index: 2;
}
button {
    background: transparent;
    border: none;
}
.register {
    padding: 10px 30px;
    border-radius: 12px;
    border: 2px #af3131 solid;
    transition: 0.5s;
}
.register:hover {
    background-color: #af3131;
    color: #212529;
}
@media screen and (max-width: 1024px) {
    ul li a {
        font-size: 15px;
    }
    .adaptive input {
        width: 30vw;
    }
    ul li img {
        width: 15vw;
        height: 4vw;
    }
    ul li:last-child {
        padding: 7px 25px;
    }
}
@media screen and (max-width: 768px) {    
    #logo{
        display: none;
    }
    .burger{
        display: block;
        z-index: 10;
    }
    .burger img{        
        width: 44px;
        height: 44px;
    }
    ul{
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5vw;
        margin-top: 5vw;
        font-weight: bolder;
        font-size: 30px;
    }
    li input{
        width: 50vw;
    }
    .d-f_adaptive{
        display: flex;
        flex-direction: row; 
        align-items: center;
        justify-content: space-around;
    }
}
</style>
