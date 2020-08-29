<template>
    <h1>Logging you in with google, please wait!</h1>
</template>

<script>
    export default {
        name: "GoogleCallback",
        methods: {
            login() {
                this.$store.dispatch('googleCallback', {
                    code: this.$route.query.code,
                })
                    .then((res) => {
                        location.reload();
                        // (res.data.user.roles[0].name === "teacher") ? this.$router.push({name: 'TeacherProfile'}) : this.$router.push({name: 'StudentProfile'});
                        this.$router.push({name: 'StudentProfile'})
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
