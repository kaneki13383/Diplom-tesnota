<template>
    <div class="head">
        <p>Админ панель / Главная</p>
        <h1>Главная</h1>
    </div>
    <div class="graph">
        
    </div>
</template>

<script>
export default {
    data(){
        return{

        }
    },
    mounted(){
        this.allUsers()
    },
    methods:{
        allUsers(){
            axios.get('/api/all_users')
            .then(res => {
                this.plByMonth = res.data
            })
        }
    }
}
</script>

<style lang="scss" scoped>
    .head{
        display: flex;
        flex-direction: column;
        width: 80%;
        margin-left: 10%;
        margin-top: 2vw;
        font-size: 18px;
        border-bottom: 2px solid #af3131;
        padding-bottom: 35px;
        p{
            color: #af3131;
            font-family: "Comfortaa", serif;
        }
        h1{
            color: white;
            font-family: "Comfortaa", serif;
            margin-top: 25px;
        }
    }
    .graph{
        width: 80%;
        margin-left: 10%;
        color: white;
    }
</style>