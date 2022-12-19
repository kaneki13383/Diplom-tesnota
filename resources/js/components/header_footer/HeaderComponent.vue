<template>
    <div>
        <header>
            <ul>
                <li>
                    <router-link to="/"
                        ><img src="/img/logo.png" alt=""
                    /></router-link>
                </li>
                <li><router-link to="/">Главная</router-link></li>
                <li><router-link to="">Меню</router-link></li>
                <li v-show="token"><router-link to="">Корзина</router-link></li>
                <li><router-link to="/about">О нас</router-link></li>
                <li>
                    <input type="search" placeholder="Поиск" /><img
                        class="search"
                        src="img/search.png"
                        alt=""
                    />
                </li>
                <li>
                    <router-link v-show="!token" class="register" to="/register"
                        >Регистрация</router-link
                    >
                    <router-link v-show="token" to="/dashboard">{{
                        this.$store.state.user.name
                    }}</router-link>
                </li>
                <a class="burger-menu_button">
                    <span class="burger-menu_lines"></span>
                </a>
            </ul>
        </header>
    </div>
</template>

<script>
export default {
    data() {
        return {
            token: "",
            name: "",
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
        // window.addEventListener("resize", function(){
        //     let width_window = this.innerWidth;

        //     // console.log(width_window);
        //     if(width_window >= 1025){
        //         document.getElementById('navig').style.display = 'flex'
        //         document.getElementById('navig').style.opacity = '1'
        //     }else{
        //         document.getElementById('navig').style.display = 'none'
        //         document.getElementById('navig').style.opacity = '0'
        //         document.getElementById('burger').style.position = 'absolute'
        //     }
        // }, false);
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
        // display(){
        //     if(document.getElementById('navig').style.opacity == '1'){
        //         document.getElementById('navig').style.opacity = '0'
        //         document.getElementById('navig').style.display = 'none'
        //         document.getElementById('burger').style.position = 'absolute'
        //     }else{
        //         document.getElementById('navig').style.opacity = '1'
        //         document.getElementById('navig').style.display = 'flex'
        //         document.getElementById('burger').style.position = 'fixed'
        //     }
        // }
    },
};
</script>

<style lang="css" scoped>
header {
    margin-top: 30px;
    margin-bottom: 30px;
}
ul {
    display: flex;
    justify-content: space-evenly;
    align-items: center;
}
ul li img {
    width: 150px;
    height: 40px;
}
ul li a {
    color: white;
    font-family: "Comfortaa", cursive;
    font-size: 18px;
}
.burger-menu_button {
    display: none;
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
}
li input::placeholder {
    color: white;
}
.search {
    width: 30px;
    height: 30px;
    margin-left: -50px;
    margin-bottom: -10px;
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
    ul li:last-child {
        padding: 7px 25px;
    }
}
@media screen and (max-width: 768px) {
    ul li:not(:first-child) {
        display: none;
    }
    ul li:nth-child(6) {
        display: block;
    }
    ul li img {
        width: 20vw;
    }
    .burger-menu_button {
        position: relative;
        display: flex;
        justify-content: center;
        z-index: 30;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        -webkit-transition: 0.4s;
        -moz-transition: 0.4s;
        -o-transition: 0.4s;
        transition: 0.4s;
    }
    .burger-menu_lines::before,
    .burger-menu_lines::after,
    .burger-menu_lines {
        position: absolute;
        top: 40px;
        width: 50px;
        height: 3px;
        background-color: #af3131;
        -webkit-transition: 0.4s;
        -moz-transition: 0.4s;
        -o-transition: 0.4s;
        transition: 0.4s;
    }
    .burger-menu_lines {
        transform: translate(-50%, -50%);
    }
    .burger-menu_lines::before {
        content: "";
        top: -12px;
    }
    .burger-menu_lines::after {
        content: "";
        top: 12px;
    }
}
</style>
