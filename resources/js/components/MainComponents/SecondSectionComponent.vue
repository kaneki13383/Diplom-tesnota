<template>
    <div class="background">
        <h3>Кафе "Теснота" - кафе, которое вы искали</h3>
        <div class="d-f_info">
            <div class="text">
                <p>Наше кафе является один из самых лучших в городе, у нас постоянно пополняется каталог товаров, у нас приятная музыка и астомсфера.</p>
                <div class="links">
                    <a href="">Узнать подробнее</a>
                    <a href="">Каталог</a>
                </div>
            </div>
            <div>
                <img src="img/second_section_img.png" alt="">
            </div>
        </div>
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
        height: 101vh;
        display: flex;
        flex-direction: column;
    }
    h3{
        color: white;
        font-size: 45px;
        font-family: 'Comfortaa', cursive;
        margin-left: 100px;
        margin: 115px 115px 115px;
    }
    .d-f_info{
        color: white;
        display: flex;
        justify-content: space-evenly;
    }
    .text{
        font-size: 36px;
        width: 750px;
        font-family: 'Roboto', sans-serif;
        font-weight: bold;
    }
    div img{
        width: 720px;
    }
    .links{
        display: flex;
        font-size: 24px;
        gap: 30px;
        font-family: 'Comfortaa', cursive;
        margin-top: 140px;
    }
    .links :first-child{
        color: white;
        text-decoration: none;
        border: 2px #AF3131 solid;
        padding: 20px 100px;
        border-radius: 28px;
        transition: 0.5s;
    }
    .links :first-child:hover{
        background: #AF3131;
        color: #212529;
    }
    .links :last-child{
        color: white;
        text-decoration: none;
        border: 2px #AF3131 solid;
        padding: 17px 70px;
        border-radius: 28px;
        transition: 0.5s;
    }
    .links :last-child:hover{
        background: #AF3131;
        color: #212529;
    }
</style>