<template>
    <h1>Logging you in with facebook, please wait!</h1>
</template>

<script>
    export default {
        name: "FacebookCallback",
        methods: {
            login() {
                this.$store.dispatch('facebookCallback', {
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
