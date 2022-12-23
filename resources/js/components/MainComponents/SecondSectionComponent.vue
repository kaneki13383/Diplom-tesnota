<template>
    <div class="background">
        <h3>Кафе "Теснота" - кафе, которое вы искали</h3>
        <div class="d-f_info">
            <div class="text">
                <p>
                    Наше кафе является один из самых лучших в городе, у нас
                    постоянно пополняется каталог товаров, у нас приятная музыка
                    и астомсфера.
                </p>
                <div class="links">
                    <a href="">Подробнее</a>
                    <a href="">Меню</a>
                </div>
            </div>
            <div>
                <img src="img/second_section_img.png" alt="" />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {};
    },
};
</script>

<style lang="css" scoped>
.background {
    height: 100vh;
    display: flex;
    flex-direction: column;
}
h3 {
    color: white;
    font-size: 45px;
    font-family: "Comfortaa", cursive;
    margin-left: 100px;
    margin: 115px 115px 115px;
}
.d-f_info {
    color: white;
    display: flex;
    justify-content: space-evenly;
}
.text {
    font-size: 36px;
    width: 40vw;
    font-family: "Roboto", sans-serif;
    font-weight: bold;
}
div img {
    width: 750px;
    border-radius: 15px;
}
.links {
    display: flex;
    font-size: 24px;
    gap: 30px;
    font-family: "Comfortaa", cursive;
    margin-top: 140px;
}
.links :first-child {
    color: white;
    text-decoration: none;
    border: 2px #af3131 solid;
    padding: 20px 100px;
    border-radius: 28px;
    transition: 0.5s;
}
.links :first-child:hover {
    background: #af3131;
    color: #212529;
}
.links :last-child {
    color: white;
    text-decoration: none;
    border: 2px #af3131 solid;
    padding: 17px 70px;
    border-radius: 28px;
    transition: 0.5s;
}
.links :last-child:hover {
    background: #af3131;
    color: #212529;
}
@media screen and (max-width: 1524px) {
    div img {
        width: 40vw;
    }
    .text {
        font-size: 25px;
    }
    .links {
        font-size: 1.2vw;
        font-weight: bold;
        margin-top: 8vw;
    }
    h3 {
        font-size: 37px;
    }
}
@media screen and (max-width: 1200px) {
    .d-f_info {
        flex-direction: column-reverse;
        justify-content: center;
        align-items: center;
    }
    h3 {
        text-align: center;
    }
    div img {
        width: 70vw;
        margin-bottom: 5vw;
    }
    .text {
        width: 70vw;
        text-align: center;
    }
    .links {
        font-size: 24px;
        justify-content: center;
    }
}
@media screen and (max-width: 850px) {
    .links {
        font-size: 17px;
    }
    .links :first-child {
        text-align: center;
        padding: 17px 70px;
    }
}
@media screen and (max-width: 650px) {
    .background {
        align-items: center;
    }
    .links :first-child {
        padding: 15px 50px;
    }
    .links :last-child {
        padding: 15px 50px;
    }
    h3 {
        font-size: 30px;
        width: 80%;
    }
}
@media screen and (max-width: 426px) {
    h3 {
        font-size: 27px;
    }
    .links :first-child {
        padding: 10px 30px;
    }
    .links :last-child {
        padding: 10px 30px;
    }
    .text {
        font-size: 20px;
    }
}
</style>
