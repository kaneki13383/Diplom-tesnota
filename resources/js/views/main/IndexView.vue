<template>
    <transition name="scale" mode="out-in">
        <div v-if="this.$route.path === '/register' || this.$route.path === '/login'"></div>
        <HeaderComponentVue v-else></HeaderComponentVue>
    </transition>   
    


    <router-view v-slot="{ Component, route }">
        <transition name="scale" >
            
            <component :is="Component" :key="route.path" ></component>
        </transition>
    </router-view>

    <transition name="scale" mode="out-in">
        <div v-if="this.$route.path === '/register' || this.$route.path === '/login'"></div>
        <FooterComponentVue v-else></FooterComponentVue>
    </transition>
</template>
<script lang="ts">
import HeaderComponentVue from '../../components/header_footer/HeaderComponent.vue';
import FooterComponentVue from '../../components/header_footer/FooterComponent.vue';
export default {
    components: { HeaderComponentVue, FooterComponentVue },

    data (){
        return{
            
        }
    },

    mounted(){
        
    },

    computed: {
        headerTab() {  
            if(this.$route.path === '/register'){
                HeaderComponentVue
            }
        }
    },
    
}
</script>
<style lang="css" scoped>
    @import url('https://fonts.googleapis.com/css2?family=Comfortaa&display=swap'); /* font-family: 'Comfortaa', cursive; */
    @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap'); /* font-family: 'Roboto', sans-serif; */
    @import url('https://fonts.googleapis.com/css2?family=Cabin&display=swap'); /* font-family: 'Cabin', sans-serif; */

    .scale-enter-active,
    .scale-leave-active {
        transition: all 0.3s;
    }
    .scale-enter-from, .scale-leave-to {
        opacity: 0;
    }
</style>