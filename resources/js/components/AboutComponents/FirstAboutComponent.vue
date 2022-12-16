<template>
    <div class="background">
        <div class="h_pag">
            <p class="pagination">Главная / Профиль / О нас</p>
            <h2>О нас</h2>
        </div>
        <div class="d-f_why_we">
            <div class="why_we">
                <h3>Почему именно мы?</h3>
                <p>Потому, что у нас только свежие продукты, которые привозят каждый день. Все блюда, приготовленные нашими поварами, получили максимальныые оценки критиков! Наше кафе работает уже на протяжении 10 лет, люди посетившие наше заведение остаются довольными и сытыми. ТЕСНОТА - выбор гурманов!</p>
            </div>
            <div class="why_we">
                <h3>Наши особенности</h3>
                <p>Наш шеф-повар получил премию "Лучший шеф-повар года". Зерна для нашего кофе поставляются исключительно из Колубии. Блюда приготовленные в нашем кафе имеют доступную цену. В честь праздников мы делаем притные бонусы и скидки.</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {

        };
    },
};
</script>

<style lang="css" scoped>
    .pagination {
        color: #af3131;
        font-size: 18px;
        font-family: "Comfortaa", serif;
        margin-top: 30px;
    }
    h2 {
        font-family: "Comfortaa", serif;
        font-size: 32px;
        color: white;
        margin-top: 15px;
        margin-bottom: 30px;
    }
    .h_pag{
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .why_we{
        color: white;
        margin-top: 75px;
    }
    .why_we h3{
        font-size: 32px;
        font-family: "Comfortaa", serif;
        margin-bottom: 40px;
    }
    .why_we p{
        font-size: 20px;
        width: 840px;
        font-family: 'Roboto', sans-serif;
    }
    .d-f_why_we{
        display: flex;
        flex-direction: column;
        gap: 90px;
    }
</style>
