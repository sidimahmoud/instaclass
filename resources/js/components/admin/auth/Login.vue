<template>
    <div class="container border-top border-primary pt-5">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="signup-form bg-white">
                    <form method="post" @submit.prevent="login">
                        <h2>Sign in</h2>
                        <p class="hint-text">Admin authentication.</p>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" v-if="errorMessage">
                            <strong>Error!</strong> {{errorMessage}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email"
                                   required="required" v-model="email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password"
                                   required="required" v-model="password">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block " :disabled="authLoading">
                                <span v-if="!authLoading">Sign in </span>
                                <div class="text-center text-white" v-if="authLoading">
                                    <span class="spinner-border spinner-border-sm" role="staitus" aria-hidden="true"/>
                                    Loading...
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {

        name: "Login",

        data() {
            return {
                email: '',
                password: '',
                errorMessage: ''
            }
        },
        methods: {

            login() {
                let email = this.email;
                let password = this.password;
                this.$store.dispatch('login', {email, password})
                    .then(res=>{
                        (res.data.user.roles[0].name==="teacher")?this.$router.push({name: 'TeacherProfile'}):this.$router.push({name: 'StudentProfile'});
                        return true
                    })
                    .catch(err => this.errorMessage = err.response.data.message)
            },
        },
        computed: mapGetters(["authLoading"])
    }
</script>

<style scoped>


    .signup-form {
        margin: 0 auto;
        padding: 30px 0;
    }

    .signup-form h2 {
        color: #636363;
        margin: 0 0 15px;
        position: relative;
        text-align: center;
    }

    .signup-form h2:before, .signup-form h2:after {
        content: "";
        height: 2px;
        width: 30%;
        background: #d4d4d4;
        position: absolute;
        top: 50%;
        z-index: 2;
    }

    .signup-form h2:before {
        left: 0;
    }

    .signup-form h2:after {
        right: 0;
    }

    .signup-form .hint-text {
        color: #999;
        margin-bottom: 30px;
        text-align: center;
    }

    .signup-form {
        color: #999;
        border-radius: 3px;
        margin-bottom: 15px;
        background: #ffffff;
        box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .signup-form .form-group {
        margin-bottom: 20px;
    }

    .signup-form input[type="checkbox"] {
        margin-top: 3px;
    }

    .signup-form .btn {
        font-size: 16px;
        font-weight: bold;
        min-width: 140px;
        outline: none !important;
    }

    .signup-form .row div:first-child {
        padding-right: 10px;
    }

    .signup-form .row div:last-child {
        padding-left: 10px;
    }

    .signup-form a:hover {
        text-decoration: none;
    }


    .signup-form form a:hover {
        text-decoration: underline;
    }

    .btn-google {
        color: white;
        background-color: #ea4335
    }

    .btn-github {
        color: white;
        background: #4267B2;
    }

</style>
