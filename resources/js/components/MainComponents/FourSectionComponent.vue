<template>
    <div class="background">
        <div>
            <img src="img/pc_map.png" alt="" />
            <img class="ipad" src="img/ipad.png" alt="" />
            <img src="img/iphone.png" alt="" class="iphone" />
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1377.4017779367769!2d48.02732657606127!3d46.33359419475461!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x41a90ff35bb686f1%3A0xb2edbefe2d723933!2z0JrQuNC-0YHQuiDQnNC-0YDQvtC20LXQvdC-0LUg0KHQu9Cw0LLQuNGG0LA!5e0!3m2!1sru!2sru!4v1670929406020!5m2!1sru!2sru"
                width="665"
                height="417"
                style="border: 0"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        </div>
        <div class="info">
            <h4>Контакты</h4>
            <p>E-mail: danchik.kun@mail.ru</p>
            <p>8 (967) 331 27-86</p>
            <p>улица Н. Островского, 70</p>
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
.iphone {
    display: none;
}
.ipad {
    display: none;
}
.background {
    background-image: url("img/background_four_sec.png");
    height: auto;
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    height: 100vh;
}
iframe {
    position: absolute;
    margin-top: 31px;
    margin-left: -775px;
}
.info {
    width: 490px;
    height: 490px;
    background: #000000;
    border: 14px #af3131 solid;
    border-radius: 21px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.info h4 {
    color: white;
    font-size: 48px;
    font-family: "Cabin", sans-serif;
    margin-bottom: 50px;
}
.info p {
    color: white;
    font-size: 24px;
    font-family: "Cabin", sans-serif;
    margin-bottom: 25px;
}
@media screen and (max-width: 1600px) {
    .background {
        flex-direction: column;
        gap: 5vw;
        padding: 5vw 0;
    }
}
@media screen and (max-width: 900px) {
    img {
        display: none;
    }
    .background {
        flex-direction: row;
        height: 100vh;
    }
    .ipad {
        display: block;
    }
    .info {
        width: 300px;
        height: 300px;
    }
    .info h4 {
        font-size: 30px;
    }
    .info p {
        font-size: 18px;
    }
    iframe {
        margin-top: -285px;
        margin-left: 47px;
        width: 357px;
        height: 270px;
    }
}
@media screen and (max-width: 830px) {
    .background {
        flex-direction: column;
    }
}
@media screen and (max-width: 426px) {
    .ipad {
        display: none;
    }
    .iphone {
        position: relative;
        display: block;
        z-index: 2;
    }
    iframe {
        margin-top: -530px;
        width: 240px;
        height: 500px;
        z-index: 1;
        border-radius: 20px;
    }
}
</style>
