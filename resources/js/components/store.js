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
            }
        }
    },
})