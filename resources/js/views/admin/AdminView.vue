<template>
    <div>
        <button @click.prevent="logout">Выход</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            role: localStorage.getItem('role')
        };
    },
    mounted() {
        document.title = "Админка";
        if (this.role != 1) {
            this.$router.push("/")
        }
    },
    methods: {
        logout() {
            axios.post("/logout").then((res) => {
                localStorage.removeItem("x_xsrf_token");
                localStorage.removeItem("name");
                localStorage.removeItem("surname");
                localStorage.removeItem("email");
                localStorage.removeItem("id");
                localStorage.removeItem("avatar");
                localStorage.removeItem("adress");
                localStorage.removeItem("number");
                this.$router.push("/");
                // console.log(res);
            });
        },
    },
};
</script>

<style lang="css" scoped></style>
