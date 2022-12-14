<template>
    <div v-if="this.$route.path === '/register' || this.$route.path === '/login'"></div>
    <HeaderComponentVue v-else></HeaderComponentVue>

    
        <router-view></router-view>


    <div v-if="this.$route.path === '/register' || this.$route.path === '/login'"></div>
    <FooterComponentVue v-else></FooterComponentVue>
</template>
<script lang="ts">
import HeaderComponentVue from '../../components/header_footer/HeaderComponent.vue';
import FooterComponentVue from '../../components/header_footer/FooterComponent.vue';
export default {
    components: { HeaderComponentVue, FooterComponentVue },

    data (){
        return{}
    },


    computed: {
        headerTab() {  
            if(this.$route.path === '/register'){
                HeaderComponentVue
            }
        }
    }
    
}
</script>
<style lang="css" scoped>
    @import url('https://fonts.googleapis.com/css2?family=Comfortaa&display=swap'); /* font-family: 'Comfortaa', cursive; */
    @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap'); /* font-family: 'Roboto', sans-serif; */
    @import url('https://fonts.googleapis.com/css2?family=Cabin&display=swap'); /* font-family: 'Cabin', sans-serif; */
</style>