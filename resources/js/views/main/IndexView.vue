<template>
    <HeaderComponentVue></HeaderComponentVue>
    <router-view></router-view> 
    <FooterComponentVue></FooterComponentVue>
</template>
<script lang="ts">
import HeaderComponentVue from '../../components/header_footer/HeaderComponent.vue';
import FooterComponentVue from '../../components/header_footer/FooterComponent.vue';
export default {
    components: { HeaderComponentVue, FooterComponentVue },

    data (){
        return{}
    },
    
}
</script>
<style lang="css" scoped>
    @import url('https://fonts.googleapis.com/css2?family=Comfortaa&display=swap'); /* font-family: 'Comfortaa', cursive; */
    @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap'); /* font-family: 'Roboto', sans-serif; */
    @import url('https://fonts.googleapis.com/css2?family=Cabin&display=swap'); /* font-family: 'Cabin', sans-serif; */
</style>