import { createStore } from "vuex";
export default createStore({
    state() {
        return {
            user: {
                name: '',
                surname: '',
                email: '',
                adress: '',
                number: '',
                role: '',
                avatar: '',
                cart_count: 0
            },
            theme: localStorage.getItem('theme')
        }
    },
})