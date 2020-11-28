<template>
    <div>
        <section class="hero pt-5 mb-3">
<!--            <div class="container h-100">-->
<!--                <div class="row h-100">-->
<!--                    <div class="col-md-4"></div>-->
<!--                    <div class="col-md-8 text-center pt-md-5">-->
<!--                        <h1 class="font-weight-bolder ">-->
<!--                            THE NEXT <br>-->
<!--                            YOU-->
<!--                        </h1>-->
<!--                        <h1 class="font-weight-bolder text-uppercase">-->
<!--                            The best way to predict <br>-->
<!--                            the future is to create it-->
<!--                        </h1>-->
<!--                    </div>-->
<!--                </div>-->

<!--            </div>-->

        </section>
        <div class="container ">
            <div class="row">
                <div class="col-sm-9 col-md-10 col-lg-7 mx-auto">
                    <div class="signup-form bg-white">
                        <div class="row text-dark font-weight-bold d-none d-md-block">
                            <div class="col-md-12 mx-auto d-flex align-items-center">
                                <div class="col-md-3 col-sm-6">{{$t('auth.become.1')}}</div>
                                <div class="col-md-1 col-sm-6"><i class="fa fa-angle-double-right fa-5x"></i> </div>
                                <div class="col-md-3 col-sm-6">{{$t('auth.become.2')}}</div>
                                <div class="col-md-1 col-sm-6"><i class="fa fa-angle-double-right fa-5x"></i> </div>
                                <div class="col-md-2 col-sm-6">{{$t('auth.become.3')}}</div>
                                <div class="col-md-1 col-sm-6"><i class="fa fa-angle-double-right fa-5x"></i> </div>
                                <div class="col-md-1 col-sm-6">{{$t('auth.become.4')}}</div>
                            </div>

                        </div>
                        <form method="post" @submit.prevent="login">
                            <h4 class="text-uppercase text-center text-dark mt-3">{{$t('auth.become.getStarted')}}</h4>
                            <h2>{{$t('auth.signIn')}}</h2>
                            <!-- <p class="hint-text">{{$t('auth.become.login')}}
                            </p> -->
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"
                                 v-if="errorMessage">
                                <strong>Error!</strong> {{errorMessage}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control form-control-lg md-outline" name="email"
                                       placeholder="Email"
                                       required="required" v-model="email" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2"><i
                                        class="fa fa-envelope"/></span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control form-control-lg" name="password"
                                       :placeholder="$t('auth.password')"
                                       required="required" v-model="password" aria-describedby="basic-addon">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon"><i
                                        class="fa fa-lock"/></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-dark btn-lg btn-block ">
                                    <span v-if="!authLoading">{{$t('auth.signIn')}}</span>
                                    <div class="text-center text-white" v-if="authLoading">
                                        <span class="spinner-border spinner-border-sm" role="staitus"
                                              aria-hidden="true"/>
                                        Loading...
                                    </div>
                                </button>
                            </div>
                        </form>
                        <div>
                            <p class="font weight-bold text-center text-primary">
                                <router-link :to="{name: 'ResetPassword'}">
                                    {{$t('auth.forget')}}
                                </router-link>
                            </p>
                            <div class="text-center">{{$t('auth.new')}}
                                <router-link :to="{name: 'Become'}">{{$t('auth.signup')}}</router-link>
                            </div>
                            <h2>{{$t("auth.or")}}</h2>
                            <button class="btn btn-lg btn-google btn-block text-uppercase" @click="authLogin('google')">
                                <i class="fa fa-google mr-2"></i> {{$t('auth.continueWith')}} Google
                            </button>
                            <button class="btn btn-lg btn-github  btn-block text-uppercase"
                                    @click="authLogin('facebook')">
                                <i class="fa fa-facebook-f text-white mr-2"></i> {{$t('auth.continueWith')}} Facebook
                            </button>
                        </div>
                    </div>
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
                errorMessage: '',
            }
        },
        methods: {
            login() {
                let email = this.email;
                let password = this.password;
                this.$store.dispatch('login', {email, password})
                    .then(res => {
                        if(res.data.user.roles[0].name === "teacher") {
                            let r = this.$router.resolve({name: 'StudentProfile'});
                            window.location.assign(r.href)
                        }else {
                            this.errorMessage = "No teacher account with this email please verify.";
                        }
                            /* this.$router.push({name: 'TeacherProfile'}) :
                            (res.data.user.roles[0].name === "student") ?
                                this.$router.push({name: 'StudentProfile'}) : this.$router.push({name: 'Admin'}); */
                    })
                    .catch(err => {
                        console.log(err.response.data);
                        this.errorMessage = err.response.data.message
                        err.response.data.message === "email unverified" ? this.$router.push({name: 'Email'}) :
                            this.errorMessage = "Please verify your Email address or password and try again";
                    })
            },
            // loginGithub() {
            //     this.$store.dispatch('socialStudentAuth', "google")
            //         .then((res) => {
            //             console.log(res);
            //             if (res.data.url) {
            //                 console.log(res.data.url);
            //                 window.location.href = res.data.url
            //             }
            //         })
            //         .catch(err => console.log(err))
            // },
            authLogin(provider) {
                this.$store.dispatch('socialTeacherAuth', provider)
                    .then((res) => {
                        let r = this.$router.resolve({name: 'StudentProfile'});
                        window.location.assign(r.href)
                    })
                    .catch(err => console.log(err))
            },
        },
        computed: mapGetters(["authLoading"])
    }
</script>

<style scoped>
    .hero {
        /*background-image: url('../../assets/images/demand/online.jpg');*/
        background: linear-gradient(rgba(19, 19, 19, 0.5), rgba(19, 19, 19, 0.5)), url('../../assets/images/auth/Become1.jpg') no-repeat center center;
        height: 70vh;
        background-size: cover;
        border-bottom: 15px solid #3081FB;
        color: white;
    }

    .signup-form {
        margin: 0 auto;
        margin-bottom: 15px;
        background: #ffffff;
        border: 2px solid black;
        border-bottom: 2px solid black;
        border-radius: 5%;
        padding: 20px;

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
        background: #000;
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
        color: #000;
        margin-bottom: 30px;
        text-align: center;
    }

    .signup-form {
        color: #999;
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

    .btn-github a {
        color: white;
    }

    .btn-google a {
        color: white;
    }

    .md-form.md-outline label.active {
        background: #eeeeef;
    }

    input {
        border: 2px solid black !important;
        background: transparent;
    }

    .input-group-text {
        display: flex;
        align-items: center;
        padding: 0.375rem 0.75rem;
        margin-bottom: 0px;
        font-size: 0.9rem;
        font-weight: 400;
        line-height: 1.6;
        text-align: center;
        white-space: nowrap;
        background-color: transparent;
        border: none;
        border-radius: 0.25rem;
        margin-left: -40px;
        z-index: 1;
    }
</style>
