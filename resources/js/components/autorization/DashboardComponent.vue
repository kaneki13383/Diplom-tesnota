<template>
    <div class="d-f">
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
            <p>Ваше имя: {{name}}</p>
            <p>Ваша почта: {{email}}</p>
        </div>        
    </div>
    <div>
        <h3><span>—</span> Оставьте свой отзыв <span>—</span></h3>
        <div class="review-df"> 
            <div class="counter">{{counter}}/255</div>
            <textarea v-model="review" class="review" name="review" id="" maxlength="255" placeholder="Оставите отзыв о нашей компании"></textarea>
            <button v-on:click="Review1()" class="button_sub">Отправить</button>
        </div>   
    </div>
    <div><FooterView></FooterView></div>
</template>

<script>

export default {
  components: { },
    data(){
        return{
            name: '',
            email: '',
            file: '',
            id: '',
            avatar: '',
            review: ''
        }
    },

    mounted(){
        if(localStorage.getItem('x_xsrf_token')){
            HeaderComponent.data.token = localStorage.getItem('x_xsrf_token')
        }
        this.getName()
        this.getEmail()
        this.getAvatar()
            this.getId()
        document.title = this.name;
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
                localStorage.removeItem('user')
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
            this.name = localStorage.getItem('user')
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
        Review1(){
            let formData = new FormData();
            formData.append('review', this.review);
            formData.append('name_user', this.name);
            formData.append('avatar', this.avatar)
            axios.post('/api/review', 
            formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                },
                )
            
            .then(res =>{
                console.log()
            })
        }
    }
}
</script>

<style lang="css" scoped>
    .logout{
        display: flex;
        margin-top: 10vh;
        flex-wrap: wrap;
        flex-direction: column;
        justify-content: space-evenly;
        align-items: baseline;
        align-content: space-around;
        align-items: center;
    }
    .counter{
        color: white;
        font-size: 1.2vw;
        font-family: 'Comfortaa', sans-serif;
        position: absolute;
        margin: 8vw 0;
        margin-left: 17vw;
    }
    .logout p{
        color: white;
        font-size: 1.2vw;
        font-family: 'Comfortaa', sans-serif;
        margin-bottom: -1vw;
    }
    .logout button{
        width: 20vw;
        height: 50px;
        background-color: transparent;
        color:  white ;
        font-size: 1.2vw;
        font-family: 'Philosopher', sans-serif;
        border:  #9fc926 2px solid;
        margin-top: 5vh;
    }
    .logout button:hover{
        background-color: #9fc926;
        color: #191D21;
        transition-duration: 0.5s;
    }
    .logout input{
        width: 20vw;
        height: 50px;
        background-color: transparent;
        color: white;
        font-size: 1.2vw;
        font-family: 'Philosopher', sans-serif;
        border:  #9fc926 2px solid;
        margin-top: 5vh;
        /* opacity: 0; */
        display: none;
    }
    label{
        background-color: transparent;
        font-family: 'Philosopher', sans-serif;
        color: white;
        font-size: 1.2vw;
        border: 2px #9fc926 solid;
        width: 20vw;
        height: 50px;
        margin-top: 3vw;
        padding-top: 0.5vh;
        text-align: center;
    }
    .logout input, label:hover{
        background-color: #9fc926;
        color: #191D21;
        transition-duration: 0.5s;
    }
    .logout img{
        width: 250px;
        height: 250px;
        border-radius: 200px;
    }
    .d-f{
        display: flex;        
        align-items: baseline;
        justify-content: space-around;
    }
    .info{
        background-color: #191D21;
        width: 700px;
        height: 400px;
        color: white;
        font-size: 1.5vw;
        font-family: 'Comfortaa', cursive;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding-left: 3vw;
    }
    h3{
      color: white;
      text-align: center;
      font-size: 2vw;
      margin: 8vw 0;
      font-family: 'Comfortaa', cursive;
    }
    h3 span{
      color: #9FC926;
    }
    .review-df{
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .review{
        color: white;
        resize: none;
        background: transparent;
        width: 500px;
        height: 200px;
        border: #9FC926 2px solid;
        font-size: 1.2vw;
        font-family: 'Comfortaa', sans-serif;
    }
    button{
    width: 10vw;
    height: 50px;
    background-color: transparent;
    color: white;
    font-size: 1.2vw;
    font-family: 'Philosopher', sans-serif;
    border: #9FC926 2px solid;
    margin-top: 5vh;
    }
    form button:hover{
    background-color: #9FC926;
    color: #191D21;
    transition-duration: 0.5s;
    }
    
    input::placeholder, textarea::placeholder{
        color: white;
        font-size: 1vw;
        padding: 1vw;
        font-family: 'Comfortaa', cursive;
    }

    @media screen and (max-width: 1024px) {
        .d-f{
            flex-direction: column;
            align-items: center;
            gap: 10vw;
        }
        .info{
            font-size: 1.2rem;
        }
    }
</style>
