<template>
    <div class="background">
        <form>
            <h2>Изенить даные</h2>
            <input type="text" placeholder="Имя">
            <input type="text" placeholder="Фамилия">
            <input type="text" placeholder="Email">
            <input type="password" placeholder="Пароль">
            <!-- <input type="file" id="file" ref="file" required v-on:change="handleFileUpload()">
            <p v-show="file.name">{{file.name}}</p>
            <button v-on:click="submitFile()">Загрузить</button> -->
            <button>Сохранить</button>
        </form>
    </div>
</template>

<script>
export default {
    data () {
        return {
            file: '',
            id: '',
            avatar: '',
        }
    },

    mounted(){
        this.getId()
    },  

    methods:{
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
        
        getId(){
            this.id = localStorage.getItem('id')
        },
    }
}
</script>

<style lang="css" scoped>
    .background{
        background: #202428;
        border: 3px #AF3131 solid;
        width: 1150px;
        height: auto;
        border-radius: 15px;
        color: white;
    }
    h2{
        font-size: 24px;
        font-family: 'Comfortaa', serif;
    }
    form{
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 80px;
        margin: 40px 0;
    }
    input{
        width: 80%;
        height: 60px;
        background: #1D2023;
        border: 2px #AF3131 solid;
        border-radius: 9px;
        color: white;
        font-size: 20px;
        padding-left: 20px;
    }
    input::placeholder{
        color: white;
        font-size: 20px;
    }
    button{
        width: 350px;
        height: 45px;
        background: #1D2023;
        border: 2px #AF3131 solid;
        border-radius: 9px;
        color: white;
        font-size: 16px;
        font-family: 'Comfortaa', serif;
        transition: 0.5s;
    }
    button:hover{
        background: #AF3131;
        color: #1D2023;
        cursor: pointer;
    }
</style>