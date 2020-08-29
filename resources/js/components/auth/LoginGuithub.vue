<template>
    <h1>Logging in , please wait!</h1>
</template>

<script>
    export default {
        name: "LoginGuithub",
        data() {
            return {
                provider: "google"
            }
        },
        methods: {
            login() {

                this.$store.dispatch('socialStudentAuthCallback', {code: this.$route.query.code, provider: this.provider})
                    .then((res) => {
                        console.log(res);
                        this.$router.push('/');
                    })
                    .catch(err => console.log(err))
            },
        },
        created() {
            // this.loginGithub()
            this.login()
        }
    }

</script>

<style scoped>

</style>
