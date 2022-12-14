<template>
    <div class="background">
        <form>
            <h2>Данные для заказа</h2>
            <input type="text" placeholder="Адрес доставки">
            <input type="text" placeholder="Номер телефона">
            <input type="text" placeholder="Промокод (если есть)">
            <button>Сохранить</button>
        </form>
    </div>
</template>

<script>
export default {
    data () {
        return {

        }
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