import { createRouter, createWebHistory } from "vue-router";
import MainView from '../views/main/MainView.vue';
// import RegisterComponent from '../components/RegisterComponent.vue';
// import LoginComponent from '../components/LoginComponent.vue';
// import GetComponent from '../components/GetComponent.vue';
// import DashboardComponent from '../components/DashboardComponent.vue';

const router = new createRouter({
    base: "/",
    history: createWebHistory(),
    routes: [
        { path: "/", component: MainView},
        // { path: "/register", component: RegisterComponent},
        // { path: "/login", component: LoginComponent},
        // { path: "/get", component: GetComponent},
        // { path: "/dashboard", component: DashboardComponent},
    ],
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('x_xsrf_token')

    if(!token && to.path == '/dashboard'){
        if (to.path === '/login' || to.path === '/register'){
            return next();
        } else{
            return next({
                path: '/login'
            })
        }
    }

    if ((to.path === '/login' || to.path === '/register') && token){
        return next({
            path: '/dashboard'
        })
    }

    next()
})

export default router;