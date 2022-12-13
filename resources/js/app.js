import './bootstrap';
import IndexComponent from './views/main/IndexView.vue';
import router from './router';
import {createApp} from 'vue';

createApp(IndexComponent).use(router).mount('#app');