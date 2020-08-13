<template>
    <h1>Logging with github, please wait!</h1>
</template>

<script>
    export default {
        name: "LoginGuithub",
        methods:{
            loginGithub() {
                this.$store.dispatch('loginGithubCallback', {code: this.$route.query.code})
                    .then((res) => {
                        console.log(res);
                        if (res.data.url){
                            console.log(res.data.url)
                        }
                    })
                    .catch(err => console.log(err))
            },
        },
        created() {
            this.loginGithub()
        }
    }

</script>

<style scoped>

</style>
