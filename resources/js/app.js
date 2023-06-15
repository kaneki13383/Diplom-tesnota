import './bootstrap';
import IndexComponent from './views/main/IndexView.vue';
import router from './router';
import { createApp } from 'vue';
import store from './components/store';
import * as VeeValidate from 'vee-validate';

createApp(IndexComponent).use(router).use(store).use(VeeValidate).mount('#app');
