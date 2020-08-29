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
                let data = {
                    code: this.$route.query.code,
                    provider: this.provider
                };
                this.$store.dispatch('socialStudentAuthCallback', data)
                    .then((res) => {
                        console.log(res);
                        location.reload();
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
