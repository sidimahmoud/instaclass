<template>
    <h1>Logging in , please wait!</h1>
</template>

<script>
    export default {
        name: "LoginGuithub",
        data() {
            return {
                provider: ''
            }
        },
        methods: {
            login() {
                this.$route.path.includes('google')?this.provider = "google": this.$route.path.includes('facebook')?this.provider = "facebook":this.provider = "google";
                this.$store.dispatch('socialStudentAuthCallback', {
                    code: this.$route.query.code,
                    provider: this.provider
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
