<template>
    <div class="d-f_sec">
        <div class="text">
            <h4>Здесь вы можете оставить свою заявку</h4>
            <p>Для этого будет достаточно вашего телефонного номера и электронного адреса. Так же вы можете добавить в комментарии свои пожелания
                и упростить работу для нашего сервиса:)</p>
        </div>
        <div class="request">
            <input type="text" placeholder="тел">
            <input type="text" placeholder="почта">
            <textarea name="" id="" cols="30" rows="10" placeholder="коментарий"></textarea>
            <button>Отправить</button>
            <img src="img/bottom_form_main.svg" alt="">
        </div>
    </div>
</template>

<script>
export default {
    setup () {
        

        return {}
    }
}
</script>

<style lang="css" scoped>
    h4{
        font-size: 64px;
        font-family: 'Comfortaa', cursive;
        color: #AF3131;
        width: 810px;
        text-align: center;
    }
    .d-f_sec{
        display: flex;
        justify-content: space-evenly;
        align-items: center;        
        margin-bottom: 175px;
    }
    .text p{
        color: white;
        font-family: 'Roboto', sans-serif;
        font-weight: bold;
        width: 800px;
        margin-top: 50px;
        text-align: center;
        font-size: 30px;
    }
    .request{
        height: 730px;
        width: 600px;
        border: 6px #AF3131 solid;
        border-radius: 95px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-evenly;
        padding-top: 50px;
    }
    input[type=text]{
        width: 435px;
        height: 65px;
        background-color: #1D2023;
        border: 5px #AF3131 solid;
        border-radius: 9px;
        color: white;
        font-size: 20px;
        font-family: 'Cabin', sans-serif;
        font-weight: bold;
        padding-left: 20px;
    }
    input::placeholder{
        color: white;
        font-size: 20px;
        font-family: 'Cabin', sans-serif;
        font-weight: bold;
    }
    textarea::placeholder{
        color: white;
        font-size: 20px;
        font-family: 'Cabin', sans-serif;
        font-weight: bold;
    }
    textarea{
        width: 435px;
        background-color: #1D2023;
        border: 5px #AF3131 solid;
        border-radius: 9px;
        resize: none;
        color: white;
        font-size: 20px;
        font-family: 'Cabin', sans-serif;
        font-weight: bold;
        padding-left: 20px;
        padding-top: 20px;
    }
    .request button{
        width: 250px;
        height: 65px;
        background: transparent;
        border: 5px #AF3131 solid;
        border-radius: 9px;
        color: white;
        font-size: 20px;
        font-family: 'Comfortaa', cursive;
        transition: 0.5s;
        cursor: pointer;
    }
    .request button:hover{
        background: #AF3131;
        color: #1D2023;
    }
    img{
        position: relative;
        top: 21px;
        right: 2px;
        width: 605px;
    }
</style>